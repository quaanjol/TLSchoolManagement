<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\_CONST;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user == null) {
            return redirect('/login');
        }

        // dd($user);
        if($user->role_id == _CONST::ADMIN_ROLE_ID) {
            return redirect('/admin/dashboard');
        } else if($user->role_id == _CONST::SUB_ADMIN_ROLE_ID) {
            return redirect('/admin/dashboard');
        } else if($user->role_id == _CONST::TEACHER_ROLE_ID) {
            return redirect('/teacher/dashboard');
        } else if($user->role_id == _CONST::PARENT_ROLE_ID) {
            return redirect('/parent/dashboard');
        } else if($user->role_id == _CONST::STUDENT_ROLE_ID) {
            return redirect('/student/dashboard');
        }
    }
}
