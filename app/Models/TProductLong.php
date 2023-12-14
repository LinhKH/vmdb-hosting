<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TProductLong extends Model
{
    protected $table = 't_product_long';

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    public function product():BelongsTo
    {
        return $this->belongsTo(TProduct::class, 'product_id');
    }
}
