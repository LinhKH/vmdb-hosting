<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Applications\CommonMstService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TPlace extends Model
{

    protected $table = 't_place';
    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';

    protected $appends = ['order_form_name', 'order_form_return_name'];

    public function getOrderFormNameAttribute(): array
    {
        $mstId = 'order_form';
        $attr = 'code_value';
        $value = $this->use_form_ids;
        return CommonMstService::findDispValueBySplitString($mstId, $attr, $value);
    }

    public function getOrderFormReturnNameAttribute(): array
    {
        $mstId = 'order_form';
        $attr = 'code_value';
        $value = $this->use_form_return_ids;
        return CommonMstService::findDispValueBySplitString($mstId, $attr, $value);
    }

    /**
     * @return BelongsTo
     */
    public function placeMaster(): BelongsTo
    {
        return $this->belongsTo(TPlaceMaster::class, 'master_id');
    }

    /**
     * @return BelongsTo
     */
    public function locationMaster(): BelongsTo
    {
        return $this->belongsTo(LocationMaster::class, 'center_id');
    }
}
