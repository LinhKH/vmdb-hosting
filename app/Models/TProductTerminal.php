<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


class TProductTerminal extends Model
{
    protected $table = 't_product_terminal';

    public const CREATED_AT = 'reg_dt';
    public const UPDATED_AT = null;

    public function product():BelongsTo
    {
        return $this->belongsTo(TProduct::class, 'product_id');
    }

    public function terminal(): BelongsTo
    {
        return $this->belongsTo(TTerminal::class, 'terminal_id');
    }
}
