<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\TerminalService;

class TerminalController extends Controller
{
    private $terminalService;

    public function __construct(
        TerminalService $terminalService
    ) {
        $this->terminalService = $terminalService;
    }


    public function index(Request $request)
    {
        $terminalLists = $this->terminalService->getTerminalList(collect($request->all()));
        return $terminalLists;
    }

    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ], [], ['id' => __('label.t_terminal.id')]);
        $terminalDetail = $this->terminalService->findById($request->id);
        return $terminalDetail;
    }
}
