<?php

namespace App\Services\Applications;

use App\Models\TOption;
use App\Pagination\ApiPagination;
use Illuminate\Support\Collection;
use App\Constant\Common;

class OptionFrominService
{
    /**
     * @param Collection $conditions
     * @return ApiPagination
     */
    public function getOptionFromList(Collection $conditions): ApiPagination
    {
        $conditions = $conditions->filter(function ($value, $key) {
            return $value !== null;
        });

        $query =  TOption::query()->with(['optionFromins.tsupportCountry', 'optionFromins' => function ($qr) {
            $qr->normal();
        }]);

        if ($conditions->has('id')) {
            $query->where('id', $conditions->get('id'));
        }

        if ($conditions->has('name')) {
            $query->where('name', $conditions->get('name'));
        }

        if ($conditions->has('type')) {
            $query->where('type', $conditions->get('type'));
        }
        if ($conditions->has('item_yn')) {
            $query->where('item_yn', $conditions->get('item_yn'));
        }

        if ($conditions->has('order_by')) {
            $sort = substr($conditions->get('order_by'), 0, 1) === '+' ? 'asc' : 'desc';
            switch (substr($conditions->get('order_by'), 1)) {
                case 'reg_dt':
                    $query->orderBy('reg_dt', $sort)->orderBy('id', $sort);
                    break;
                case 'order_no':
                    $query->orderBy('order_no', $sort);
                    break;
                default:
                    break;
            }
        } else {
            $query->orderBy('reg_dt', 'desc')->orderBy('id', 'desc');
        }

        $optionList = $query->paginate($conditions->get('per_page', Common::PER_PAGE));
        return $optionList;
    }

    public function findById(int $id): TOption
    {
        return TOption::with(['optionFromins.tsupportCountry', 'optionFromins' => function ($qr) {
            $qr->normal();
        }])->findOrFail($id);
    }
}
