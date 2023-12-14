<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Applications\CommonMstService;

class MasterController extends Controller
{


    public function __construct()
    {
    }


    public function index(Request $request)
    {
        $mst_id = $request->input('mst_id');
        $result = [];
        if (!empty($mst_id)) {
            if (is_string($mst_id)) {
                $mst_id = [$mst_id];
            }
            $result = CommonMstService::getInstance($mst_id)->getAll();
            
        }
        return response()->json($result, 200);
    }


    public function sql(Request $request)
    {

        $mst_id = 'support_country_stop_yn';
        $mst_nm = 'support_country_stop_yn';
        $arrCommon = SupportCountryStopYN::toSelectArray();
        $template = "INSERT INTO `m_common_mst` ( `mst_id`, `mst_nm`, `code_value`, `sort_value`, `disp_value`)  VALUES (':mst_id', ':mst_nm', ':code_value', ':sort_value', ':disp_value');";
        $result = "";
        $index = 1;
        foreach ($arrCommon as $key => $val) {
            $code_value = $key;
            $sort_value = $index;
            $disp_value = $val;
            $result .=  str_replace([':mst_id', ':mst_nm', ':code_value', ':sort_value', ':disp_value'], [$mst_id, $mst_nm, $code_value, $sort_value, $disp_value], $template)."\n";
            $index++;
        }
        echo $result;die;
    }
}
