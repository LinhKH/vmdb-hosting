<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\SearchConditionService;


class SearchController extends Controller
{
    private $searchConditionService;

    public function __construct(SearchConditionService $searchConditionService )
    {
        $this->searchConditionService = $searchConditionService;

    }

    public function index(Request $request)
    {
        $condition = $this->searchConditionService->restoreConditions();
        $page = $this->searchConditionService->restorePage();
        $res = array_merge($condition, ['page' => $page]);
        $res = array_filter($res);
        if(empty($res)){
            $res = null;
        }
        return response()->json($res, 200);
    }


}
