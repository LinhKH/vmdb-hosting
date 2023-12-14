<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


class TProductFromin extends Model
{
    protected $table = 't_product_fromin';

    public const CREATED_AT = 'reg_dt';
    public const UPDATED_AT = 'upd_dt';

    public function product(): BelongsTo
    {
        return $this->belongsTo(TProduct::class, 'product_id')->latest();
    }

    public function supportCountry(): BelongsTo
    {
        return $this->belongsTo(TSupportCountry::class, 'fromin_id');
    }
}
