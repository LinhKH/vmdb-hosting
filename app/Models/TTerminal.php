<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use App\Models\BaseModel;

class TTerminal extends BaseModel
{
    protected $table = 't_terminal';

    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';


    protected $guarded = [
        'reg_dt',
        'upd_dt',
    ];

    public function supportCountries(): HasManyThrough
    {
        return $this->hasManyThrough(
            TSupportCountry::class,
            TTerminalSupportCountry::class,
            'terminal_id',
            'id',
            'id',
            'support_country_id'
        );
    }
    
    public function site(): BelongsTo
    {
        return $this->belongsTo(TSite::class);
    }

    
    public function registrantAdmin(): BelongsTo
    {
        return $this->belongsTo(TAdmin::class, 'reg_admin_id');
    }

    public function updaterAdmin(): BelongsTo
    {
        return $this->belongsTo(TAdmin::class, 'upd_admin_id');
    }

    public function productTerminals(): HasMany
    {
        return $this->hasMany(TProductTerminal::class, 'terminal_id');
    }

    public function getOrderNameAttribute(): string
    {
        return $this->maker_name . '　　' . $this->name;
    }

    public function products(): HasManyThrough 
    {
        return $this->HasManyThrough(
            TProduct::class,
            TProductTerminal::class,
            'terminal_id',
            'id',
            'id',
            'product_id'
        );
    }
}
