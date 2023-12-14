<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

trait UtilOperation
{
    /**
     * 対象モデルの更新可能なカラムを配列で返す
     * @return array
     */
    public static function getNonGuardedPropertyKeyList(): array
    {
        $model = new self();
        $columns = $model->getGuarded();
        $attributes = Schema::getColumnListing($model->getTable());

        $result = collect($attributes)->reject(function ($value) use ($columns) {
            return in_array($value, $columns, true);
        })->values()->toArray();

        return $result;
    }

    /**
     * 更新可能なカラム以外を除外し返す
     * @param Collection $requestData
     * @return array
     */
    public static function filterRequestByFillable(Collection $requestData): array
    {
        $fillableItemList = self::getNonGuardedPropertyKeyList();
        return $requestData->filter(function ($value, $key) use ($fillableItemList) {
            return in_array($key, $fillableItemList, true);
        })->toArray();
    }
}
