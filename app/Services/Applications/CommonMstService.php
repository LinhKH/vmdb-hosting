<?php

namespace App\Services\Applications;

use App\Models\MCommonMst;

class CommonMstService
{
    private static $instance = null;
    private static $arrData = [];
    private function __construct() {
    }

    public static function getInstance($arrMstId) {
        if (self::$instance === null) {
            self::$instance = new CommonMstService();
        }
        self::load($arrMstId);
        return self::$instance;
    }

    private static function load($arrMstId = []){
        if(empty($arrMstId)){
            return;
        }
        $mstIdNew = [];
        foreach($arrMstId as $mst){
            if(empty(self::$arrData[$mst])){
                $mstIdNew[] = $mst;
            }
        }
        if(!empty($mstIdNew)){
            $arrMst = MCommonMst::whereIn('mst_id', $mstIdNew)->get()->sortBy('code_value')->groupBy('mst_id');
            self::$arrData = $arrMst->mergeRecursive(self::$arrData);
        }

    }

    public static function getAll() {
        return self::$arrData->toArray();
    }

    public function findByAttr($mstId, $attr, $value){
        if(empty(self::$arrData[$mstId])){
            return null;
        }
        return self::$arrData[$mstId]->firstWhere($attr, $value);
    }

    public static function findDispValueBySplitString($mstId, $attr, $value){
        $oMst = self::getInstance([$mstId]);
        return collect(explode(',', $value))
            ->reject(function ($m) {
                return $m === '';
            })
            ->map(function ($m) use($oMst, $mstId, $attr) {
                $dispValue = $oMst->findByAttr($mstId, $attr, $m);
                return !empty($dispValue) ? $dispValue['disp_value'] : '';
            })
            ->reject(function ($m) {
                return empty($m);
            })->values()->toArray();
    }

    
}
