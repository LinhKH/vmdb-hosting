<?php

namespace App\Services\Applications;

use App\Models\TPlaceMaster;
use Illuminate\Support\Collection;

class PlaceMasterService 
{
    public function fetchPlaceMasterList(): Collection
    {
        return TPlaceMaster::get();
    }
}
