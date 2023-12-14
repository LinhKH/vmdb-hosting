<?php

namespace App\Services\Applications;

use App\Models\LocationMaster;
use Illuminate\Support\Collection;

class LocationMasterService 
{
    public function fetchLocationMasterList(): Collection
    {
        return LocationMaster::normal()->get();
    }
}
