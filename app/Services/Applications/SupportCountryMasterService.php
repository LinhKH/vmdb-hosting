<?php

namespace App\Services\Applications;

use Illuminate\Support\Collection;
use App\Models\TSupportCountryMaster;

class SupportCountryMasterService 
{
    public function fetchSupportCountryMasterList(): Collection
    {
        return TSupportCountryMaster::orderBy('phonetic')->get();
    }
}