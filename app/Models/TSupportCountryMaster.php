<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TSupportCountryMaster extends Model
{
    protected $table = 't_support_country_master';
    public $timestamps = false;

    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';

    protected $dates = [
        'reg_dt',
        'upd_dt'
    ];
}
