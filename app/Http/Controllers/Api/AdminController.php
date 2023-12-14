<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\AdminService;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(
        AdminService $adminService
    ) {
        $this->adminService = $adminService;
    }

    public function adminData(Request $request){
        return $this->adminService->fetchAdminList();
    }
}
