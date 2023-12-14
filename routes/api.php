<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Common\MasterController;
use App\Http\Controllers\Api\Common\SearchController;
use App\Http\Controllers\Api\SupportCountryController;
use App\Http\Controllers\Api\SupportCountryGroupController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TerminalController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\LocationMasterController;
use App\Http\Controllers\Api\PlaceMasterController;
use App\Http\Controllers\Api\OptionController;
use App\Http\Controllers\Api\OptionPlanController;
use App\Http\Controllers\Api\OptionFrominController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $res = $request->user();
    $res->menu = $res->menu;
    return $res;
});


// public route
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/forgot', [AuthController::class, 'forgot']);
Route::post('/auth/reset_password', [AuthController::class, 'reset_password']);

Route::get('/commonmst_sql', [MasterController::class, 'sql']);


// protected route
Route::group(['middleware' => ['auth:sanctum','authority']], function(){
    Route::get('/search_condition', [SearchController::class, 'index'])->name('get_search_condition');
    Route::post('/commonmst', [MasterController::class, 'index'])->name('commonmst');
    Route::post('/support_country_master_list', [SupportCountryController::class, 'supportCountryMaster'])->name('support_country_master_list');
    Route::post('/support_country_group_list', [SupportCountryController::class, 'supportCountryGroup'])->name('support_country_group_list');
    Route::get('/support_country_detail', [SupportCountryController::class, 'detail'])->name('support_country_detail');
    Route::get('/support_country_group_detail', [SupportCountryGroupController::class, 'detail'])->name('support_country_group_detail');
    Route::get('/product_detail', [ProductController::class, 'detail'])->name('product_detail');
    Route::get('/terminal_detail', [TerminalController::class, 'detail'])->name('terminal_detail');
    Route::get('/place_detail', [PlaceController::class, 'detail'])->name('place_detail');
    Route::get('/option_detail', [OptionController::class, 'detail'])->name('option_detail');
    Route::get('/option_detail_by_id', [OptionController::class, 'listOptionById'])->name('option_detail_by_id');
    Route::get('/option_plan_detail', [OptionPlanController::class, 'detail'])->name('option_plan_detail');
    Route::get('/option_from_detail', [OptionFrominController::class, 'detail'])->name('option_from_detail');

    Route::post('/support_country_data', [SupportCountryController::class, 'supportCountryData'])->name('support_country_data');
    Route::post('/admin_data', [AdminController::class, 'adminData'])->name('admin_data');
    Route::post('/location_master_data', [LocationMasterController::class, 'locationMasterData'])->name('location_master_data');
    Route::post('/place_master_data', [PlaceMasterController::class, 'placeMasterData'])->name('place_master_data');

    Route::group(['middleware' => ['search']], function(){
        Route::post('/support_country_search', [SupportCountryController::class, 'index'])->name('support_country_list');
        Route::post('/support_country_group_search', [SupportCountryGroupController::class, 'index'])->name('support_country_group_list');
        Route::post('/product_list_search', [ProductController::class, 'index'])->name('product_list');
        Route::post('/terminal_list_search', [TerminalController::class, 'index'])->name('terminal_list');
        Route::post('/place_list_search', [PlaceController::class, 'index'])->name('place_list');
        Route::post('/option_list_search', [OptionController::class, 'index'])->name('option_list');
        Route::post('/option_plan_list_search', [OptionPlanController::class, 'index'])->name('option_plan_list_search');
        Route::post('/option_from_list_search', [OptionFrominController::class, 'index'])->name('option_from_list');
        

        
    });
    
});