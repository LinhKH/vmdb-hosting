<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


class TOptionCountryRelation extends Model
{
    protected $table = 't_option_country_relation';

    public const CREATED_AT = 'reg_dt';
    public const UPDATED_AT = 'upd_dt';

    public function option():BelongsTo
    {
        return $this->belongsTo(TOption::class, 'option_id');
    }

    public function supportConutry(): BelongsTo
    {
        return $this->belongsTo(TSupportCountry::class, 'support_country_id');
    }
}
