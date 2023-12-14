<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\OptionService;

class OptionController extends Controller
{
    private $optionService;

    public function __construct(
        OptionService $optionService
    ) {
        $this->optionService = $optionService;
    }


    public function index(Request $request)
    {
        $optionLists = $this->optionService->getOptionList(collect($request->all()));
        return $optionLists;
    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_option.id')]);
        $optionDetail = $this->optionService->findById($request->id);
        return $optionDetail;
    }
    public function listOptionById(Request $request)
    {
        $optionDetail = $this->optionService->getOptionById($request->id);
        return $optionDetail;
    }
}
