<?php

namespace App\Services\Applications;

use App\Models\TSupportCountry;
use App\Pagination\ApiPagination;
use Illuminate\Support\Collection;
use App\Constant\Common;

class SupportCountryService
{
    /**
     * @param Collection $conditions
     * @return ApiPagination
     */
    public function getSupportCountryList(Collection $conditions): ApiPagination
    {
        $conditions = $conditions->filter(function ($value, $key) {
            return $value !== null;
        });

        $query = TSupportCountry::query();

        if ($conditions->has('id')) {
            $query->where('id', '=', $conditions->get('id'));
        }

        if ($conditions->has('item_type')) {
            $query->where('item_type', '=', $conditions->get('item_type'));
        }

        if ($conditions->has('area_no')) {
            $query->where('area_no', '=', $conditions->get('area_no'));
        }

        if ($conditions->has('name')) {
            $query->where('name', 'LIKE', '%'.$conditions->get('name').'%');
        }

        if ($conditions->has('rental_days_max')) {
            $query->where('rental_days_max', '=', $conditions->get('rental_days_max'));
        }

        if ($conditions->has('stop_yn')) {
            $query->where('stop_yn', '=', $conditions->get('stop_yn'));
        }

        if ($conditions->has('sim_type')) {
            $query->where('sim_type', '=', $conditions->get('sim_type'));
        }

        if ($conditions->has('just_before_status')) {
            $query->where('just_before_status', '=', $conditions->get('just_before_status'));
        }

        if ($conditions->has('site_code')) {
            $query->where('site_code', 'LIKE', '%'.$conditions->get('site_code').'%');
        }

        if ($conditions->has('site_order_flag')) {
            $query->where('site_order_flag', '=', $conditions->get('site_order_flag'));
        }

        if ($conditions->has('site_list_flag')) {
            $query->where('site_list_flag', '=', $conditions->get('site_list_flag'));
        }

        if ($conditions->has('site_detail_flag')) {
            $query->where('site_detail_flag', '=', $conditions->get('site_detail_flag'));
        }
        
        if ($conditions->has('admin_order_flag')) {
            $query->where('admin_order_flag', '=', $conditions->get('admin_order_flag'));
        }

        if ($conditions->has('order_by')) {
            $sort = substr($conditions->get('order_by'), 0, 1) === '+' ? 'asc' : 'desc';
            switch (substr($conditions->get('order_by'), 1)) {
                case 'reg_dt':
                    $query->orderBy('reg_dt', $sort)->orderBy('id', $sort);
                    break;
                case 'area_no':
                    $query->orderBy('area_no', $sort)->orderBy('order_no', $sort);
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

        
        if ($conditions->has('master_id')) {
            $query->where('master_id', '=', $conditions->get('master_id'));
        }

        $supportCountries = $query->paginate($conditions->get('per_page', Common::PER_PAGE));

        return $supportCountries;
    }

    public function fetchSupportCountryList(): Collection
    {
        return TSupportCountry::get();
    }

    public function findById(int $id): TSupportCountry
    {
        return TSupportCountry::with('supportCountryMaster:id,name')->findOrFail($id);
    }
}
