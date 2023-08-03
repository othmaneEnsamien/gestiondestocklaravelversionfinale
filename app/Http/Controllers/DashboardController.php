<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;

class DashboardController extends Controller
{
    // public function userRolesPermissionsChart()
    // {
    //     $data = DB::table('users')
    //         ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    //         ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    //         ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
    //         ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
    //         ->select('users.name', 'roles.name as role', 'permissions.name as permission')
    //         ->get();

    //     $chart = Charts::database($data, 'bar', 'highcharts')
    //         ->title('Roles and Permissions per User')
    //         ->elementLabel('Total')
    //         ->dimensions(3000, 1500)
    //         ->groupBy('name')
    //         ->groupBy('role')
    //         ->groupBy('permission');

    //     return view('home', compact('chart'));
    // }
}