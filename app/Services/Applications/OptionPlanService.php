<?php

namespace App\Services\Applications;

use App\Models\TOptionPlan;
use Illuminate\Support\Collection;
use App\Pagination\ApiPagination;
use App\Constant\Common;

class OptionPlanService 
{
    
    /**
     * @param Collection $conditions
     * @return ApiPagination
     */
    public function getOptionPlanList(Collection $conditions): ApiPagination
    {
        $conditions = $conditions->filter(function ($value, $key) {
            return $value !== null;
        });
        $query = TOptionPlan::with(['options:id,name']);

        if ($conditions->has('id')) {
            $query->where('id', '=', $conditions->get('id'));
        }
        if ($conditions->has('display_name')) {
            $query->where('display_name', 'LIKE', '%' . $conditions->get('display_name') . '%');
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
            $query->orderBy('reg_dt', 'desc');
        }
        $terminals = $query->paginate($conditions->get('per_page', Common::PER_PAGE));
        return $terminals;
    }
    public function findById(int $id): TOptionPlan
    {
        return TOptionPlan::with(['options:id,name'])->findOrFail($id);
    }
}