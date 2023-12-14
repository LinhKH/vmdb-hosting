<?php

namespace App\Services\Applications;

use App\Models\TAdmin;
use Illuminate\Support\Collection;
use App\Pagination\ApiPagination;
use App\Constant\Common;

class AdminService 
{
    public function fetchAdminList(): Collection
    {
        return TAdmin::normal()->get();
    }
}
