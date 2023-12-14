<?php

namespace App\Mail;

use App\Models\TAdmin;
use App\Models\TAdminTokenPassword;
use App\Models\TSite;
use App\ValueObjects\PasswordResetExpirationDate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ResetPasswordConfirm
 */
class ResetPasswordConfirm extends Mailable
{
    use Queueable;
    use SerializesModels;

    const SUBJECT = 'パスワード再設定URL';

    /**
     * @var TSite
     */
    protected $site;

    /**
     * @var TAdmin
     */
    protected $admin;

    /**
     * @var TAdminTokenPassword
     */
    protected $adminTokenPassword;

    /**
     * Create a new message instance.
     *
     * @param Site $site
     * @param Admin $admin
     * @param AdminTokenPassword $adminTokenPassword
     */
    public function __construct(
        TSite $site,
        TAdmin $admin,
        TAdminTokenPassword $adminTokenPassword
    ) {
        $this->site = $site;
        $this->admin = $admin;
        $this->adminTokenPassword = $adminTokenPassword;
    }

    /**
     * Build the message.
     *
     * @see resources\views\emails\reset_password.blade.php
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => $this->site->mail_from, 'name' => $this->site->mail_from_name])
            ->replyTo($this->site->mail_reply_to)
            ->subject(self::SUBJECT)
            ->text('emails.reset_password')
            ->with([
                'adminName' => $this->admin->name,
                'token' => $this->adminTokenPassword->token,
                'reminderLimit' => PasswordResetExpirationDate::DESCRIPTION,
            ]);
    }
}
