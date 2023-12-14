<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TOptionFromin extends BaseModel
{
    protected $table = 't_option_fromin';

    public const CREATED_AT = 'reg_dt';
    public const UPDATED_AT = 'upd_dt';


    public function tsupportCountry(): BelongsTo
    {
        return $this->belongsTo(TSupportCountry::class, 'fromin_id');
    }
    public function toption(): BelongsTo
    {
        return $this->belongsTo(TOption::class, 'peg_id');
    }
}
