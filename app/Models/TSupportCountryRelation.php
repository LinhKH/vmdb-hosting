<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TSupportCountryRelation extends Model
{
    protected $table = 't_support_country_relation';
    public $primaryKey = 'support_country_group_id';
    public $timestamps = false;
    public $incrementing = false;

    public const CREATED_AT = 'reg_dt';
    public const UPDATED_AT = null;

    public function supportCountry(): BelongsTo
    {
        return $this->belongsTo(TSupportCountry::class);
    }

    public function supportCountryGroup(): BelongsTo
    {
        return $this->belongsTo(TSupportCountryGroup::class, 'support_country_group_id');
    }
}
