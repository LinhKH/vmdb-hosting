<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class TTerminalSupportCountry extends Model
{
    protected $table = 't_terminal_support_country';

    protected $primaryKey = null;
    public $incrementing = false;

    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = null;

    public function terminal(): BelongsTo
    {
        return $this->belongsTo(TTerminal::class);
    }

    public function supportCountry(): BelongsTo
    {
        return $this->belongsTo(TSupportCountry::class);
    }
}
