<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\PlaceService;

class PlaceController extends Controller
{
    private $placeService;

    public function __construct(
        PlaceService $placeService
    ) {
        $this->placeService = $placeService;
    }


    public function index(Request $request)
    {
        $placeLists = $this->placeService->getPlaceList(collect($request->all()));
        return $placeLists;
    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_place.id')]);
        $placeDetail = $this->placeService->findById($request->id);
        return $placeDetail;
    }
}
