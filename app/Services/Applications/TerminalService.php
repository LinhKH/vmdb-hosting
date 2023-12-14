<?php

namespace App\Services\Applications;

use App\Models\TTerminal;
use Illuminate\Support\Collection;
use App\Pagination\ApiPagination;
use App\Constant\Common;

class TerminalService 
{
    
    /**
     * @param Collection $conditions
     * @return ApiPagination
     */
    public function getTerminalList(Collection $conditions): ApiPagination
    {
        $conditions = $conditions->filter(function ($value, $key) {
            return $value !== null;
        });
        $query = TTerminal::with('products.supportCountry:id,name', 'registrantAdmin:id,name');

        if ($conditions->has('code_name')) {
            $query->where('code_name', '=', $conditions->get('code_name'));
        }

        if ($conditions->has('maker_name')) {
            $query->where('maker_name', 'LIKE', '%' . $conditions->get('maker_name') . '%');
        }

        if ($conditions->has('name')) {
            $query->where('name', 'LIKE', '%' . $conditions->get('name') . '%');
        }

        if ($conditions->has('search_support_country_id')) {
            $query->whereHas('products.supportCountry', function ($q) use ($conditions) {
                $q->where('t_support_country.id', '=', $conditions->get('search_support_country_id'));
            });
        }

        if ($conditions->has('reg_admin_id')) {
            $query->where('reg_admin_id', '=', $conditions->get('reg_admin_id'));
        }

        if ($conditions->has('search_reg_dt')) {
            $search_reg_dt = $conditions->get('search_reg_dt');
            if ($conditions->get('search_reg_dt_cond_compare') == 1) {
                $query->whereDate('reg_dt', '>=', $search_reg_dt);
            }

            if ($conditions->get('search_reg_dt_cond_compare') == 2) {
                $query->whereDate('reg_dt', '<=', $search_reg_dt);
            }

            if (!$conditions->has('search_reg_dt_cond_compare')) {
                $query->whereDate('reg_dt', '=', $search_reg_dt);
            }
        }

        if ($conditions->has('order_by')) {
            $sort = substr($conditions->get('order_by'), 0, 1) === '+' ? 'asc' : 'desc';
            switch (substr($conditions->get('order_by'), 1)) {
                case 'sort_no':
                    $query->orderBy('sort_no', $sort);
                    break;
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
            $query->orderBy('sort_no', 'desc');
        }
        $terminals = $query->paginate($conditions->get('per_page', Common::PER_PAGE));
        return $terminals;
    }
    public function findById(int $id): TTerminal
    {
        return TTerminal::with('products.supportCountry:id,name', 'registrantAdmin:id,name', 'updaterAdmin:id,name')->findOrFail($id);
    }
}
