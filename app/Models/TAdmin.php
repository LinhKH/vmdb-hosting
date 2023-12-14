<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Services\Applications\MenuService;

class TAdmin extends Authenticatable
{
    protected $table = 't_admin';
    public const MAX_LOGIN_ID_LENGTH = 32;
    public const MAX_PASSWORD_LENGTH = 16;
    use HasApiTokens, HasFactory, Notifiable;

    public const CREATED_AT = 'reg_dt';
    public const UPDATED_AT = 'upd_dt';
    
    protected $dates = [
        'password_limit_day',
        'del_dt',
        'login_dt',
        'mail_dt',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getMenuAttribute()
    {
        return MenuService::enabledMenu($this->auth);
    }
    public function scopeNormal($query)
    {
        return $query->where('status', '=', 'N');
    }
}
