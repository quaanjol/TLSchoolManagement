<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Controllers\_CONST;

class TeacherController extends Controller
{
    // show
    public function show() {
        $user = auth()->user();
        if($user == null || $user->role_id != _CONST::STUDENT_ROLE_ID) {
            return redirect('/login');
        }

        $student = $user->Student;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả giảng viên", "english" => "Dashboard"];
        $teachers = Employee::where('type' , '=', 'teacher')->paginate(6);

        return view('student.web.teacher.list')->with([
            'user' => $user,
            'student' => $student,
            'theme' => $theme,
            'heading' => $heading,
            'teachers' => $teachers,
        ]);
    }
}
