<?php

namespace App\Services\Applications;

use App\Models\TAdmin;
use App\Services\Applications\RolesService;
use App\Enums\AdminAuthRole;


class MenuService
{
    private static function getMenu(){
        return [

            [
                'name' => 'api',
                'sub' => [
                    [
                        'name' => 'api',
                        'sub' => ['commonmst', 'support_country_master_list', 'get_search_condition'],
                        'role' => RolesService::getRole('all')
                    ],
                ],
            ],
            [
                'name' => 'ホーム',
                'sub' => [
                    [
                        'name' => 'ホーム',
                        'sub' => ['home'],
                        'role' => RolesService::getRole('all')
                    ],
                ],
            ],
            [
                'name' => '404',
                'sub' => [
                    [
                        'name' => '404',
                        'sub' => ['page_404'],
                        'role' => RolesService::getRole('all')
                    ],
                ],
            ],
            [
                'name' => '担当者管理',
                'sub' => [
                    [
                        'name' => '担当者管理',
                        'sub' => ['admin_list','admin_edit'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => '対応国管理',
                        'sub' => ['support_country_list','support_country_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => '周遊国管理',
                        'sub' => ['support_country_group_list','support_country_group_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => '商材管理',
                        'sub' => ['product_list', 'product_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => '端末管理',
                        'sub' => ['terminal_list', 'terminal_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => '場所一覧',
                        'sub' => ['place_list', 'place_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => 'オプション一覧',
                        'sub' => ['option_list', 'option_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => 'オプション一覧',
                        'sub' => ['option_from_list', 'option_from_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                    [
                        'name' => 'オプションプラン',
                        'sub' => ['option_plan_list', 'option_plan_detail'],
                        'role' => RolesService::getRole('admin')
                    ],
                ]
            ],
        ];
    }

    public static function canAccess(TAdmin $admin, string $requestPrefix): bool
    {
        $menu = static::getMenu();
        $roles = [];
        foreach ($menu as $main) {
            foreach ($main['sub'] as $sub) {
                if (in_array($requestPrefix, $sub['sub'], true)) {
                    $roles = $sub['role'];
                }
            }
        }
        $currentRole = $admin->auth;
        if ($currentRole === AdminAuthRole::MASTER) {
            return true;
        }
        return empty($roles) || in_array($currentRole, $roles);
    }


    public static function enabledMenu($auth){
        $allow_menu = [];
        $currentRole = $auth;
        $menu = static::getMenu();
        foreach ($menu as $main) {
            foreach ($main['sub'] as $sub) {
                $allow = false;
                if ($currentRole === AdminAuthRole::MASTER) {
                    $allow = true;
                }else{
                    $roles = $sub['role'];
                    $allow = empty($roles) || in_array($currentRole, $roles);
                }
                if($allow){
                    $allow_menu = array_merge($allow_menu, $sub['sub']);
                }
            }
        }
        return $allow_menu;
    }

}
