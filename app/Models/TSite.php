<?php

namespace App\Models;
use App\Models\BaseModel;
use App\Services\Util;

class TSite extends BaseModel
{
    protected $table = 't_site';
    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';
    
    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'date',
    ];

    public function isAllowedIPAddress(string $ipAddress): bool
    {
        for ($i = 1; $i <= 10; $i++) {
            $attribute = 'netmask' . $i;
            $netmask = $this->$attribute;
            if (empty($netmask)) {
                return false;
            }

            if (! Util::isNetworkRangeText($netmask)) {
                continue;
            }
            if (Util::isIPAddressInNetworkRange($ipAddress, $netmask)) {
                return true;
            }
        }

        return false;
    }

}
