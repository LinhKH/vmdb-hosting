<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TPlaceMaster extends Model
{
    protected $table = 't_place_master';
    protected $primaryKey = 'place_master_id';

    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';
}
