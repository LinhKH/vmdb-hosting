<?php

namespace App\Services\Model;

use App\Service\Util;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Core
{

    public static function appendDefaultVal($arrData, $mode='insert'){
        if($mode == 'insert'){
            $arrData['created_at'] = Carbon::now()->toDateTimeString();
            if(Auth::check()){
                $arrData['create_user_id'] = Auth::user()->id;
            }
            
        }
        $arrData['updated_at'] = Carbon::now()->toDateTimeString();
        if(Auth::check()){
            $arrData['update_user_id'] = Auth::user()->id;
        }
        return $arrData;
    }
    public static function insert($sTable, $arrData)
    {
        try {
            $arrData = Util::convertBlankToNull($arrData);
            $arrData = self::encode_data($arrData, $sTable);
            $arrData = self::appendDefaultVal($arrData);
            if(!$id = DB::table($sTable)->insertGetId($arrData)){
                throw new Exception();
            }
            return $id;
        } catch (Exception $e) {
            Log::error($e->getMessage(), [__CLASS__ . ':' . __FUNCTION__ . ':' . $e->getLine()]);
        }
        return false;
    }

    public static function update($sTable, $arrData)
    {
        try {
            $arrData = Util::convertBlankToNull($arrData);
            $arrData = self::encode_data($arrData, $sTable);
            $affected = DB::table('sTable')
              ->where('id', $arrData['id'])
              ->update($arrData);
            return $affected;
        } catch (Exception $e) {
            Log::write('ERROR', $e->getMessage(), __CLASS__ . ':' . __FUNCTION__ . ':' . $e->getLine());
        }
        return false;
    }

    public static function encode_data($arrUpSert, $table = null)
    {
        try {
            $secret_key = config('app.db_secret_key');
            $secret_column = config('app.db_secret_column');
            if (!empty($arrUpSert) && is_array($arrUpSert) && isset($secret_column[$table])) {
                foreach ($arrUpSert as $k => $v) {
                    if (in_array($k, $secret_column[$table])) {
                        $v = DB::raw($v);
                        $arrUpSert[$k] = DB::raw("AES_ENCRYPT($v, '$secret_key')");
                    }
                }
            }
            return $arrUpSert;
        } catch (Exception $e) {
            Log::error($e->getMessage(), __CLASS__ . ':' . __FUNCTION__ . ':' . $e->getLine());
        }
        return false;
    }


    public static function select_decode($cols = [], $type = 'string', $table = null, $alias = null)
    {
        try {
            $secret_key = config('app.db_secret_key');
            $secret_column = config('app.db_secret_column');
            if (empty($table) || !isset($secret_column[$table])) {
                return false;
            }

            if (empty($cols)) {
                $cols = $secret_column[$table];
            }
            if ($type === 'array') {
                $data = [];
                foreach ($cols as $col) {
                    if (in_array($col, $secret_column[$table])) {
                        $data[] = empty($alias) ? [DB::raw("AES_DECRYPT($col, '$secret_key')"), $col] : [DB::raw("AES_DECRYPT($alias.$col, '$secret_key')"), $col];
                    }
                }
            } else {
                $data = '';
                foreach ($cols as $col) {
                    if (in_array($col, $secret_column[$table])) {
                        $data .= " AES_DECRYPT($table.$col, '$secret_key') AS $col,";
                    }
                }
                $data = empty($data) ? $data : substr($data, 0, -1);
            }

            return $data;
        } catch (Exception $e) {
            Log::error($e->getMessage(), __CLASS__ . ':' . __FUNCTION__ . ':' . $e->getLine());
        }
        return false;
    }

    public static function where_decode($col = null, $table = null, $alias = true)
    {
        try {
            $secret_key = config('app.db_secret_key');
            $secret_column = config('app.db_secret_column');
            if (empty($table) || !isset($secret_column[$table])) {
                return false;
            }

            if (in_array($col, $secret_column[$table])) {
                if ($alias === true) {
                    return "AES_DECRYPT($table.$col, '$secret_key')";
                } elseif (!empty($alias)) {
                    return "AES_DECRYPT($alias.$col, '$secret_key')";
                } else {
                    return "AES_DECRYPT($col, '$secret_key')";
                }
            }
        } catch (Exception $e) {
            Log::error( $e->getMessage(), __CLASS__ . ':' . __FUNCTION__ . ':' . $e->getLine());
        }
        return false;
    }
}
