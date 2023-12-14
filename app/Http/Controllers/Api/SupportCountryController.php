<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\SupportCountryMasterService;
use App\Services\Applications\SupportCountryGroupService;
use App\Services\Applications\SupportCountryService;

class SupportCountryController extends Controller
{
    private $supportCountryService;
    private $supportCountryMasterService;
    private $supportCountryGroupService;

    public function __construct(
        SupportCountryService $supportCountryService,
        SupportCountryMasterService $supportCountryMasterService,
        SupportCountryGroupService $supportCountryGroupService
    ) {
        $this->supportCountryService = $supportCountryService;
        $this->supportCountryMasterService = $supportCountryMasterService;
        $this->supportCountryGroupService = $supportCountryGroupService;
    }

    public function supportCountryMaster(Request $request){
        return $this->supportCountryMasterService->fetchSupportCountryMasterList();
    }
    public function supportCountryGroup(Request $request){
        return $this->supportCountryGroupService->fetchSupportCountryGroupList();
    }
    public function supportCountryData(Request $request){
        return $this->supportCountryService->fetchSupportCountryList();
    }

    public function index(Request $request)
    {
        $supportCountries = $this->supportCountryService->getSupportCountryList(collect($request->all()));
        return $supportCountries;

    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_support_country.id')]);
        $supportCountries = $this->supportCountryService->findById($request->id);
        return $supportCountries;
    }
}
