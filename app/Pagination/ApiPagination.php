<?php

namespace App\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class ApiPagination extends LengthAwarePaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'data' => $this->items->toArray(),
            'total' => $this->total(),
            'from' => $this->firstItem(),
            'to' => $this->lastItem(),
            'current_page' => $this->currentPage(),
            'per_page' => $this->perPage()
        ];
    }
}
