<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Applications\SearchConditionService;

class Search
{

    private $searchConditionService;

    public function __construct(SearchConditionService $searchConditionService)
    {
        $this->searchConditionService = $searchConditionService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->input('btn') === 'search'
        ) {
            $this->searchConditionService->destroyConditionsAndPage();
            $this->searchConditionService->keepConditions($request->all());
        } elseif ($request->input('btn') === 'clear') {
            $this->searchConditionService->destroyConditionsAndPage();
        } elseif ($request->input('btn') === 'destroy') {
            $this->searchConditionService->destroyAllConditionsAndPage();
        } elseif (is_numeric($request->input('page'))) {
            $this->searchConditionService->keepPage((int)$request->input('page'));
            $condition = $this->searchConditionService->restoreConditions();
            $request->merge(array_merge($condition, $request->all()));
        }

        return $next($request);
    }
}
