<?php

namespace App\Services\Applications;

use App\Models\TPlace;
use Illuminate\Support\Collection;
use App\Pagination\ApiPagination;
use App\Constant\Common;

class PlaceService 
{
    
    /**
     * @param Collection $conditions
     * @return ApiPagination
     */
    public function getPlaceList(Collection $conditions): ApiPagination
    {
        $conditions = $conditions->filter(function ($value, $key) {
            return $value !== null;
        });
        $query = TPlace::with(['placeMaster:place_master_id,place_master_name', 'locationMaster:id,name']);

        if ($conditions->has('id')) {
            $query->where('id', '=', $conditions->get('id'));
        }
        if ($conditions->has('status')) {
            $query->where('status', '=', $conditions->get('status'));
        }
        if ($conditions->has('stock_ctrl_yn')) {
            $query->where('stock_ctrl_yn', '=', $conditions->get('stock_ctrl_yn'));
        }
        if ($conditions->has('center_id')) {
            $query->where('center_id', '=', $conditions->get('center_id'));
        }
        if ($conditions->has('master_id')) {
            $query->where('master_id', '=', $conditions->get('master_id'));
        }
        if ($conditions->has('name')) {
            $query->where('name', 'LIKE', '%' . $conditions->get('name') . '%');
        }
        if ($conditions->has('site_status')) {
            $query->where('site_status', '=', $conditions->get('site_status'));
        }

        if ($conditions->has('order_by')) {
            $sort = substr($conditions->get('order_by'), 0, 1) === '+' ? 'asc' : 'desc';
            switch (substr($conditions->get('order_by'), 1)) {
                case 'order_no':
                    $query->orderBy('order_no', $sort);
                    break;
                case 'reg_dt':
                    $query->orderBy('reg_dt', $sort);
                    break;
                default:
                    break;
            }
        } else {
            $query->orderBy('order_no', 'desc');
        }
        $terminals = $query->paginate($conditions->get('per_page', Common::PER_PAGE));
        return $terminals;
    }
    public function findById(int $id): TPlace
    {
        return TPlace::with(['placeMaster:place_master_id,place_master_name', 'locationMaster:id,name'])->findOrFail($id);
    }
}
