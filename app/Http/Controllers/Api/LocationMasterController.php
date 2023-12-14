<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\LocationMasterService;

class LocationMasterController extends Controller
{
    private $locationMasterService;

    public function __construct(
        LocationMasterService $locationMasterService
    ) {
        $this->locationMasterService = $locationMasterService;
    }


    public function locationMasterData(Request $request)
    {
        return $this->locationMasterService->fetchLocationMasterList();
    }
}
