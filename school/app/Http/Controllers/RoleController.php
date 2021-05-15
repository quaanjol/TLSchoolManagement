<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Employee;
use App\Http\Controllers\_CONST;

class RoleController extends Controller
{
    // show
    public function show() {
        $user = auth()->user();
        
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả vị trí", "english" => "Dashboard"];

        $roles = Role::all();
        $employee = $user->Employee;

        return view('admin.web.role.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'roles' => $roles,
        ]);
    }
}
