<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\_CONST;

class DepartmentController extends Controller
{
    // show
    public function show() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::STUDENT_ROLE_ID)) {
            return redirect('/login');
        }

        $student = $user->Student;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả khoa", "english" => "Dashboard"];
        $departments = Department::orderBy('id', 'DESC')->get();

        return view('student.web.department.list')->with([
            'user' => $user,
            'student' => $student,
            'theme' => $theme,
            'heading' => $heading,
            'departments' => $departments,
        ]);
    }
}
