<?php

namespace App\Models;

use App\Models\BaseModel;

class MCommonMst extends BaseModel
{
    protected $table = 'm_common_mst';
    public $timestamps = false;

    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';

    protected $dates = [
        'reg_dt',
        'upd_dt'
    ];
}
