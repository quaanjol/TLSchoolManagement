<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
        if($user->role_id == 1) {
            return redirect('/admin/dashboard');
        } else if($user->role_id == 2) {
            return redirect('/admin/dashboard');
        } else if($user->role_id == 3) {
            return redirect('/teacher/dashboard');
        } else if($user->role_id == 4) {
            return redirect('/parent/dashboard');
        } else if($user->role_id == 5) {
            return redirect('/student/dashboard');
        }
    }
}
