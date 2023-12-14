<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Services\Applications\CommonMstService;

class TSupportCountryGroup extends Model
{

    protected $table = 't_support_country_group';

    const NORMAL_WORLD_WIFI_ID = 6;
    const UNLIMITED_WORLD_WIFI_ID = 32;
    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';

    
    protected $appends = ['world_sim_condition_name'];

    
    public function product(): HasMany
    {
        return $this->hasMany(TProduct::class, 'support_country_group_id');
    }

    public function supportCountryRelation(): HasMany
    {
        return $this->hasMany(TSupportCountryRelation::class, 'support_country_group_id');
    }

    /**
     * @return HasMany
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'support_country_group_id');
    }

    public function getWorldSimConditionNameAttribute(): array
    {
        $mstId = 'support_country_sim_type';
        $attr = 'code_value';
        $value = $this->world_sim_condition;
        return CommonMstService::findDispValueBySplitString($mstId, $attr, $value);
    }

    
    public function supportCountries()
    {
        return $this->hasManyThrough(
            'App\Models\TSupportCountry',
            'App\Models\TSupportCountryRelation',
            'support_country_group_id',
            'id',
            'id',
            'support_country_id'
        )->orderBy('name', 'asc');
    }

}
