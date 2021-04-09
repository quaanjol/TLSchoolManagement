<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Employee;

class RoleController extends Controller
{
    // show
    public function show() {
        $user = auth()->user();
        if($user == null || $user->role_id != 1) {
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
