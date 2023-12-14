<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TOptionLong extends BaseModel
{
    protected $table = 't_option_long';

    public const CREATED_AT = 'start_dt';
    public const UPDATED_AT = 'end_dt';

    public function option():BelongsTo
    {
        return $this->belongsTo(TOption::class, 'peg_id');
    }
}
