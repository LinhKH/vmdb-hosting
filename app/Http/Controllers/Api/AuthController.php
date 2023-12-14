<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Login;
use App\Http\Requests\Forgot;
use App\Http\Requests\ResetPassword;
use App\Services\Applications\AuthService;
use App\Exceptions\LoginFailedException;
use App\Exceptions\ForgotFailedException;
use App\Exceptions\ResetPasswordFailedException;

class AuthController extends Controller
{
    
    
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    public function logout( Request $request){
        $this->authService->logout();
        return [
            'message' => 'Logged out'
        ];
    }

    public function login(Login $request){
        $validated = $request->validated();
        try {
            $admin = $this->authService->login($validated['login_id'], $validated['password'], $request->server->get('REMOTE_ADDR'));
            return response()->json($admin->toArray(), 200);
        } catch (LoginFailedException $e) {
            return response(['message' => $e->getMessages()], 401);
        }
    }

    public function forgot(Forgot $request){
        $validated = $request->validated();
        try {
            $admin = $this->authService->forgot($validated['login_id']);
            return response()->json($admin, 200);
        } catch (ForgotFailedException $e) {
            return response(['message' => $e->getMessages()], 401);
        }
    }

    public function reset_password(ResetPassword $request){
        $validated = $request->validated();
        try {
            $this->authService->reset_password($validated);
            return response()->json([], 200);
        } catch (ResetPasswordFailedException $e) {
            return response(['message' => $e->getMessages()], 401);
        }
    }
}
