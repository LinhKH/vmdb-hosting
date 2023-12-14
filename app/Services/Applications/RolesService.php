<?php

namespace App\Services\Applications;

use App\Enums\AdminAuthRole;


class RolesService
{
    public static function getRole($role)
    {

        switch ($role) {
            case 'admin':
                return [
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER
                ];
                break;
            case 'agency':
                return [
                    AdminAuthRole::PARTNER,
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::SALES,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'agencydownload':
                return [
                    AdminAuthRole::WORKER,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::MASTER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::AIRPORTMASTER,
                ];
                break;
            case 'contactmain':
                return [
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::WORKER,
                    AdminAuthRole::SALES,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'membermain':
                return [
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::WORKER,
                    AdminAuthRole::SALES,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'memberquest':
                return [
                    AdminAuthRole::PARTNER,
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::WORKER,
                    AdminAuthRole::SALES,
                    AdminAuthRole::BOARD,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;

            case 'shipmain':
                return [
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::WORKER,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'orderjust':
                return [
                    AdminAuthRole::PARTNER,
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::WORKER,
                    AdminAuthRole::SALES,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'whitelist':
                return [
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'troublemain':
                return [
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::WORKER,
                    AdminAuthRole::SALES,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'report':
                return [
                    AdminAuthRole::BOARD,
                    AdminAuthRole::SALES,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                    AdminAuthRole::AIRPORTMASTER,
                ];
                break;
            case 'reportregistrationform':
                return [
                    AdminAuthRole::BOARD,
                    AdminAuthRole::SALES,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'campaign':
                return [
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'campaigncsv':
                return [
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
            case 'airport':
                return [
                    AdminAuthRole::MASTER,
                    AdminAuthRole::AIRPORTMASTER,
                ];
                break;
            case 'system':
                return [
                    AdminAuthRole::MASTER,
                ];
                break;
            default:
                return [
                    AdminAuthRole::PARTNER,
                    AdminAuthRole::OFFICER,
                    AdminAuthRole::WORKER,
                    AdminAuthRole::SALES,
                    AdminAuthRole::BOARD,
                    AdminAuthRole::MARKETER,
                    AdminAuthRole::MARKET_CP,
                    AdminAuthRole::SALES_OFFICER,
                    AdminAuthRole::SV,
                    AdminAuthRole::MONEY,
                    AdminAuthRole::AIRPORT,
                    AdminAuthRole::AIRPORTMASTER,
                    AdminAuthRole::CONTROLLER,
                    AdminAuthRole::NEWMASTER,
                    AdminAuthRole::MASTER,
                ];
                break;
        }
    }
}
