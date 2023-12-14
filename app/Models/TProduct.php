<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Constant\Common;
class TProduct extends Model
{
    const TRANSIT_ID = 1018;
    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';

    /**
     * @see Model::$dates
     */
    protected $dates = [
        'reg_dt',
        'upd_dt',
    ];

    /**
     * @see Model::$table
     */
    protected $table = 't_product';

    public function productFromins(): HasMany
    {
        return $this->hasMany(TProductFromin::class, 'product_id');
    }

    public function supportCountry(): BelongsTo
    {
        return $this->belongsTo(TSupportCountry::class, 'support_country_id');
    }

    public function supportCountryGroup(): BelongsTo
    {
        return $this->belongsTo(TSupportCountryGroup::class, 'support_country_group_id');
    }

    public function productTerminals():HasMany
    {
        return $this->hasMany(TProductTerminal::class, 'product_id');
    }

    public function productLong():HasOne
    {
        return $this->hasOne(TProductLong::class, 'product_id');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', '=', Common::STATUS_NQ_NORMAL);
    }
}
