<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\SupportCountryGroupService;

class SupportCountryGroupController extends Controller
{
    private $supportCountryGroupService;

    public function __construct(
        SupportCountryGroupService $supportCountryGroupService
    ) {
        $this->supportCountryGroupService = $supportCountryGroupService;
    }


    public function index(Request $request)
    {
        $supportCountries = $this->supportCountryGroupService->getSupportCountryGroupList(collect($request->all()));
        return $supportCountries;

    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_support_country_group.id')]);
        $supportCountries = $this->supportCountryGroupService->findById($request->id);
        return $supportCountries;
    }
}
