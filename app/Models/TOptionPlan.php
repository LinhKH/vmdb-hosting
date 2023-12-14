<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Services\Applications\CommonMstService;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class TOptionPlan extends BaseModel
{

    protected $table = 't_option_plan';
    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';

    protected $appends = ['option_site_switch_name'];

    public function getOptionSiteSwitchNameAttribute(): array
    {
        $mstId = 'option_site_switch';
        $attr = 'code_value';
        $value = $this->site_show_codes;
        return CommonMstService::findDispValueBySplitString($mstId, $attr, $value);
    }

    public function options(): HasManyThrough
    {
        return $this->hasManyThrough(
            TOption::class,
            TOptionPlanRelation::class,
            'option_plan_id',
            'id',
            'id',
            'option_id'
        );
    }

}
