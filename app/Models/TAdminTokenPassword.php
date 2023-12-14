<?php

namespace App\Models;
use App\Models\BaseModel;
use App\Models\TAdmin;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TAdminTokenPassword extends BaseModel
{
    protected $table = 't_admin_token_password';
    public $timestamps = false;
    
    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'date',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(TAdmin::class, 'admin_login_id', 'login_id');
    }

}
