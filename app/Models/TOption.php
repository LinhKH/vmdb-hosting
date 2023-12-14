<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class TOption extends BaseModel
{
    protected $table = 't_option';

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    public function optionLongs(): HasMany
    {
        return $this->hasMany(TOptionLong::class, 'peg_id');
    }

    public function optionFromins(): HasMany
    {
        return $this->hasMany(TOptionFromin::class, 'peg_id');
    }

    public function optionCountryRelation(): HasMany
    {
        return $this->hasMany(TOptionCountryRelation::class, 'option_id');
    }
}
