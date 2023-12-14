<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\OptionPlanService;

class OptionPlanController extends Controller
{
    private $optionPlanService;

    public function __construct(
        OptionPlanService $optionPlanService
    ) {
        $this->optionPlanService = $optionPlanService;
    }


    public function index(Request $request)
    {
        $optionPlanLists = $this->optionPlanService->getOptionPlanList(collect($request->all()));
        return $optionPlanLists;
    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_option_plan.id')]);
        $optionPlanDetail = $this->optionPlanService->findById($request->id);
        return $optionPlanDetail;
    }
}
