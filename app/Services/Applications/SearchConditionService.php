<?php

namespace App\Services\Applications;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchConditionService
{
    
    private $screen_nm;

    public function __construct($screen_nm)
    {
        if (strlen($screen_nm) > 31) {
            $screen_nm = substr($screen_nm, 0, 32);
        }
        $this->screen_nm = $screen_nm;
    }

   
    public function keepConditions(array $conditions): void
    {
        DB::table('l_admin_condition')
            ->updateOrInsert([
                'cond_login_id' => Auth::user()->login_id,
                'cond_filename' => $this->screen_nm,
                'cond_key_name' => 'array_value',
            ], [
                'cond_value' => json_encode($conditions),
                'upd_dt' => Carbon::now(),
            ]);
    }

    public function keepPage(int $page): void
    {
        DB::table('l_admin_condition')
            ->updateOrInsert([
                'cond_login_id' => Auth::user()->login_id,
                'cond_filename' => $this->screen_nm,
                'cond_key_name' => 'page',
            ], [
                'cond_value' => $page,
                'upd_dt' => Carbon::now(),
            ]);
    }

    public function destroyConditionsAndPage(): void
    {
        DB::table('l_admin_condition')
            ->where([
                'cond_login_id' => Auth::user()->login_id,
                'cond_filename' => $this->screen_nm,
            ])
            ->delete();
    }

    
    public function destroyAllConditionsAndPage(): void
    {
        DB::table('l_admin_condition')
            ->where([
                'cond_login_id' => Auth::user()->login_id
            ])
            ->delete();
    }

   
    public function restoreConditions(): array
    {
        $conditions = [];

        $savedConditions = DB::table('l_admin_condition')
            ->where('cond_login_id', '=', Auth::user()->login_id)
            ->where('cond_filename', '=', $this->screen_nm)
            ->where('cond_key_name', '=', 'array_value')
            ->get()
            ->first();
        if ($savedConditions) {
            $conditions = json_decode($savedConditions->cond_value, true);
            is_null($conditions) && $conditions = [];
        }

        return $conditions;
    }

    public function restorePage(): ?int
    {
        $page = null;

        $savedConditions = DB::table('l_admin_condition')
            ->where('cond_login_id', '=', Auth::user()->login_id)
            ->where('cond_filename', '=', $this->screen_nm)
            ->where('cond_key_name', '=', 'page')
            ->get()
            ->first();
        if ($savedConditions) {
            $page = (int)$savedConditions->cond_value;
        }

        return $page;
    }
}
