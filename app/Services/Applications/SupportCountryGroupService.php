<?php

namespace App\Services\Applications;

use App\Models\TSupportCountryGroup;
use App\Pagination\ApiPagination;
use Illuminate\Support\Collection;
use App\Constant\Common;

class SupportCountryGroupService
{
    /**
     * @param Collection $conditions
     * @return ApiPagination
     */
    public function getSupportCountryGroupList(Collection $conditions): ApiPagination
    {
        $conditions = $conditions->filter(function ($value, $key) {
            return $value !== null;
        });

        $query = TSupportCountryGroup::with('supportCountries:id,name');
        if ($conditions->has('status')) {
            $query->where('status', '=', $conditions->get('status'));
        }
        if ($conditions->has('add_group_key')) {
            $query->where('add_group_key', '=', $conditions->get('add_group_key'));
        }
        if ($conditions->has('order_by')) {
            $sort = substr($conditions->get('order_by'), 0, 1) === '+' ? 'asc' : 'desc';
            switch (substr($conditions->get('order_by'), 1)) {
                case 'reg_dt':
                    $query->orderBy('reg_dt', $sort);
                    break;
                case 'name':
                    $query->orderBy('name', $sort);
                    break;
                default:
                    break;
            }
        } else {
            $query->orderBy('name', 'asc');
        }
        $supportCountryGroups = $query->paginate($conditions->get('per_page', Common::PER_PAGE));
        return $supportCountryGroups;
    }

    public function fetchSupportCountryGroupList(): Collection
    {
        return TSupportCountryGroup::get();
    }

    public function findById(int $id): TSupportCountryGroup
    {
        return TSupportCountryGroup::with('supportCountries:id,name')->findOrFail($id);
    }
}
