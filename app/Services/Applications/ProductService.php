<?php

namespace App\Services\Applications;

use App\Models\TProduct;
use App\Pagination\ApiPagination;
use Illuminate\Support\Collection;
use App\Constant\Common;
class ProductService
{
    /**
     * @param Collection $conditions
     * @return ApiPagination
     */
    public function getProductList(Collection $conditions): ApiPagination
    {
        $conditions = $conditions->filter(function ($value, $key) {
            return $value !== null;
        });

        $query = TProduct::query()->with([
            'supportCountry:id,name,area_no', 'supportCountryGroup:id,name',
            'productTerminals.terminal:id,name',
            'productLong',
        ]);

        if ($conditions->has('id')) {
            $query->where('id', $conditions->get('id'));
        }

        if ($conditions->has('status')) {
            $query->where('status', $conditions->get('status'));
        }

        if ($conditions->has('area_no')) {
            $areaNo = $conditions->get('area_no');
            $query->whereHas('supportCountry', function ($q) use ($areaNo) {
                $q->where('area_no', $areaNo);
            });
        }

        if ($conditions->has('support_country_id')) {
            $supportCountryId = $conditions->get('support_country_id');
            $query->where('support_country_id', $supportCountryId);
        }

        if ($conditions->has('support_country_group_id')) {
            $supportCountryGroupId = $conditions->get('support_country_group_id');
            $query->where('support_country_group_id', $supportCountryGroupId);
        }

        if ($conditions->has('terminal_type')) {
            $query->where('terminal_type', $conditions->get('terminal_type'));
        }

        if ($conditions->has('terminal_model')) {
            $query->where('terminal_model', $conditions->get('terminal_model'));
        }

        if ($conditions->has('money_common')) {
            $query->where('money_common', $conditions->get('money_common'));
        }

        if ($conditions->has('money_fast')) {
            $query->where('money_fast', $conditions->get('money_fast'));
        }

        if ($conditions->has('low_money')) {
            $lowMoney = $conditions->get('low_money');
            $query->whereHas('productLong', function ($q) use ($lowMoney) {
                $q->where('low_money', $lowMoney);
            });
        }

        if ($conditions->has('medium_money')) {
            $mediumMoney = $conditions->get('medium_money');
            $query->whereHas('productLong', function ($q) use ($mediumMoney) {
                $q->where('medium_money', $mediumMoney);
            });
        }

        if ($conditions->has('high_money')) {
            $highMoney = $conditions->get('high_money');
            $query->whereHas('productLong', function ($q) use ($highMoney) {
                $q->where('high_money', $highMoney);
            });
        }

        if ($conditions->has('order_by')) {
            $sort = substr($conditions->get('order_by'), 0, 1) === '+' ? 'asc' : 'desc';
            switch (substr($conditions->get('order_by'), 1)) {
                case 'reg_dt':
                    $query->orderBy('reg_dt', $sort)->orderBy('id', $sort);
                    break;
                default:
                    break;
            }
        } else {
            $query->orderBy('reg_dt', 'desc')->orderBy('id', 'desc');
        }

        $productList = $query->paginate($conditions->get('per_page', Common::PER_PAGE));
        return $productList;
    }

    public function findById(int $id): TProduct
    {
        return TProduct::with([
            'supportCountry:id,name,area_no', 'supportCountryGroup:id,name',
            'productTerminals.terminal:id,name',
            'productLong',
        ])->findOrFail($id);
    }
}
