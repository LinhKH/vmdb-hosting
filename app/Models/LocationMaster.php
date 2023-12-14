<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationMaster extends Model
{

    protected $table = 'location_master';
    const CREATED_AT = 'reg_date';
    const UPDATED_AT = 'update_date';

    public function scopeNormal($query)
    {
        return $query->where('del_flg', '=', 'NO');
    }
}
