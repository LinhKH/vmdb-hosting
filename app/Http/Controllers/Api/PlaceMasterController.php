<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\PlaceMasterService;

class PlaceMasterController extends Controller
{
    private $placeMasterService;

    public function __construct(
        PlaceMasterService $placeMasterService
    ) {
        $this->placeMasterService = $placeMasterService;
    }


    public function placeMasterData(Request $request)
    {
        return $this->placeMasterService->fetchPlaceMasterList();
    }
}
