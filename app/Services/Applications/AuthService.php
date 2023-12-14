<?php

namespace App\Services\Applications;

use App\Enums\AdminStatus;
use App\Exceptions\LoginFailedException;
use App\Exceptions\ForgotFailedException;
use App\Exceptions\ResetPasswordFailedException;
use App\Models\TAdmin;
use App\Models\TAdminTokenPassword;
use App\Models\TSite;
use App\Services\Applications\SecurityService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordConfirm;
use Illuminate\Support\Str;
use App\ValueObjects\PasswordResetExpirationDate;
use Illuminate\Support\Facades\Validator;
use App\Rules\AdminLoginPasswordStrength;
use App\Rules\MbAlphaNumDash;

class AuthService
{

    private $securityService;
    const MAX_LIMIT_COUNT_RESET_PASSWORD = 3;
    const MAX_LOGIN_FAIL_COUNT=5;

    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;
    }

    /**
     * @param string $loginId
     * @param string $password
     * @param string $clientIPAddress
     * @return TAdmin
     * @throws LoginFailedException
     */
    public function login(string $loginId, string $password, string $clientIPAddress): TAdmin
    {
        /* @var $admin Admin */
        $admin = TAdmin::query()->where('login_id', $loginId)->first();
        if (!$admin) {
            throw new LoginFailedException(__('messages.E-00007'));
        }

        // t_admin.status == 'Q'
        if ($admin->status === AdminStatus::QUIT) {
            throw new LoginFailedException(__('messages.E-00007'));
        }

        // t_admin.login_fail_count >= 5
        if ($admin->login_fail_count >= self::MAX_LOGIN_FAIL_COUNT) {
            throw new LoginFailedException(__('messages.E-00001'));
        }

        // today() > t_admin.password_limit_day
        $now = Carbon::createFromFormat('Y/m/d', now()->format('Y/m/d'));
        if ($now->gt($admin->password_limit_day->format('Y-m-d'))) {
            throw new LoginFailedException(__('messages.E-00010'));
        }

        if ($admin->password !== $this->securityService->encrypt($password)) {
            $admin->login_fail_count++;
            $admin->save();
            $errors = [__('messages.E-00007')];
            if ($admin->login_fail_count >= self::MAX_LOGIN_FAIL_COUNT) {
                $errors[] = __('messages.E-00001');
            }
            throw new LoginFailedException($errors);
        }

        // Check IP
        if (!$this->securityService->checkIPAddress($admin, $clientIPAddress)) {
            throw new LoginFailedException(__('messages.E-00009'));
        }

        session()->regenerate(true);

        // Update login date and time and IP address
        $admin->login_fail_count = 0;
        $admin->login_dt = Carbon::now();
        $admin->last_login_ip = $clientIPAddress;
        $admin->save();

        Auth::login($admin);

        return $admin;
    }

    /**
     * Logout
     */
    public function logout(): void
    {
        Auth::logout();
        session()->flush();
        session()->regenerate(true);
    }


     /**
     * @param string $loginId
     * @return array
     * @throws ForgotFailedException
     */
    public function forgot(string $loginId)
    {
        /* @var $admin Admin */
        $admin = TAdmin::query()->where('login_id', $loginId)->first();
        if (!$admin) {
            throw new ForgotFailedException(__('messages.E-00007'));
        }

        $tokenPassword = TAdminTokenPassword::create([
            'admin_login_id' => $admin->login_id,
            'hashCode' => md5(uniqid(mt_rand(), true)),
            'token' => Str::random(10),
            'date' => Carbon::now()
        ]);

        // send mail
        $site = TSite::find($admin->site_id);
        $confirmEmail = new ResetPasswordConfirm($site, $admin, $tokenPassword);
        Mail::to($admin->mail)->send($confirmEmail);
        return ['hash_code' => $tokenPassword->hashCode];
    }



    /**
     * @param string $loginId
     * @throws ForgotFailedException
     */
    public function reset_password($request)
    {
        /* @var $admin Admin */
        $adminTokenPassword = TAdminTokenPassword::query()->where('hashCode', $request['hashCode'])->first();
        if (!$adminTokenPassword) {
            throw new ResetPasswordFailedException(__('messages.E-00026'));
        }

        if($adminTokenPassword->token != $request['token']){
            throw new ResetPasswordFailedException(__('messages.token_not_match'));
        }

        $expirationDate = new PasswordResetExpirationDate($adminTokenPassword->date);
        if (!$expirationDate->canResetting()) {
            throw new ResetPasswordFailedException(__('messages.E-00027'));
        }

        if ($adminTokenPassword->limit_count >= self::MAX_LIMIT_COUNT_RESET_PASSWORD) {
            $adminTokenPassword->delete();
            throw new ResetPasswordFailedException(__('messages.E-00026'));
        }

        $validatorAdminLoginPasswordStrength = Validator::make($request, ['password' => [new AdminLoginPasswordStrength]]);
        if ($validatorAdminLoginPasswordStrength->fails()){
            $adminTokenPassword->limit_count++;
            $adminTokenPassword->save();
            throw new ResetPasswordFailedException(__('messages.password_not_strength'));
        }

        $validatorMbAlphaNumDash = Validator::make($request, ['password' => [new MbAlphaNumDash]]);
        if ($validatorMbAlphaNumDash->fails()){
            $adminTokenPassword->limit_count++;
            $adminTokenPassword->save();
            throw new ResetPasswordFailedException(__('messages.password_not_strength_2'));
        }

        if($request['password'] != $request['password_confirmation']){
            $adminTokenPassword->limit_count++;
            $adminTokenPassword->save();
            throw new ResetPasswordFailedException(__('messages.password_not_match'));
        }

        $admin = $adminTokenPassword->admin;
        if($admin->password == $this->securityService->encrypt($request['password'])){
            $adminTokenPassword->limit_count++;
            $adminTokenPassword->save();
            throw new ResetPasswordFailedException(__('messages.password_distinct'));
        }

        $admin->password = $this->securityService->encrypt($request['password']);
        $admin->password_limit_day = Carbon::now()->addMonths(2);
        $admin->login_fail_count = 0;
        $admin->save();
        $adminTokenPassword->delete();
        return true;
    }



}
