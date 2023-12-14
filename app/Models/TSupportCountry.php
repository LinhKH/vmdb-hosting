<?php

namespace App\Models;

use App\Models\Traits\ThroughZeroDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TSupportCountry extends Model
{
    use ThroughZeroDate;

    protected $table = 't_support_country';

    const UNLIMITED_CAPACITY_SIM = "U";
    const TRANSIT_PLAN_ID = 980;

    const CREATED_AT = 'reg_dt';
    const UPDATED_AT = 'upd_dt';

    /**
     * @return BelongsTo
     */
    public function supportCountryMaster(): BelongsTo
    {
        return $this->belongsTo(TSupportCountryMaster::class, 'master_id');
    }

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(TProduct::class, 'support_country_id');
    }

    /**
     * @return HasMany
     */
    public function productFromin(): HasMany
    {
        return $this->hasMany(TProductFromin::class, 'fromin_id');
    }

    /**
     * @return HasOne
     */
    public function supportCountryRelation(): HasOne
    {
        return $this->hasOne(TSupportCountryRelation::class, 'support_country_id');
    }

    /**
     * @return HasOne
     */
    public function toptionFromin(): HasOne
    {
        return $this->hasOne(TOptionFromin::class, 'fromin_id');
    }

    /**
     * @return hasMany
     */
    public function optionCountry(): hasMany
    {
        return $this->hasMany(TOptionCountryRelation::class, 'support_country_id');
    }

    /**
     * @return HasMany
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'support_country_id');
    }

    /**
     * @param string $value
     * @return array
     */
    public function getLossCheckMethodAttribute(string $value): array
    {
        return collect(explode(',', $value))
            ->reject(function ($m) {
                return $m === '';
            })
            ->map(function ($m) {
                return (int)$m;
            })
            ->toArray();
    }

    /**
     * @param array $value
     */
    public function setLossCheckMethodAttribute(array $value)
    {
        $this->attributes['loss_check'] = implode(',', $value);
    }

    /**
     * @param mixed $query
     * @return mixed
     */
    public function scopeNormalStatus($query)
    {
        return $query->where('status', '=', 'N');
    }

    /**
     * @return bool
     */
    public function isUnlimitedCapacity(): bool
    {
        return $this->sim_type === self::UNLIMITED_CAPACITY_SIM;
    }
}
