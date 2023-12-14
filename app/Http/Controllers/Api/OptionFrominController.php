<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\OptionFrominService;

class OptionFrominController extends Controller
{
    private $optionFrominService;

    public function __construct(
        OptionFrominService $optionFrominService
    ) {
        $this->optionFrominService = $optionFrominService;
    }


    public function index(Request $request)
    {
        $optionLists = $this->optionFrominService->getOptionFromList(collect($request->all()));
        return $optionLists;
    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_option_fromin.id')]);
        $optionFromDetail = $this->optionFrominService->findById($request->id);
        return $optionFromDetail;
    }
}
