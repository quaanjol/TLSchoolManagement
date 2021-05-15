<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Department;
use App\Http\Controllers\_CONST;

class SubjectController extends Controller
{
    // 
    public function show() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::STUDENT_ROLE_ID)) {
            return redirect('/login');
        }

        $student = $user->Student;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả môn học", "english" => "Dashboard"];
        $subjects = Subject::orderBy('id', 'DESC')->paginate(6);

        foreach($subjects as $subject) {
            $departments = [];
            foreach(unserialize($subject->departments) as $key => $value) {
                $departments[] = Department::find($value)->name;
            }
            $subject->departments = $departments;
        }

        return view('student.web.subject.list')->with([
            'user' => $user,
            'student' => $student,
            'theme' => $theme,
            'heading' => $heading,
            'subjects' => $subjects,
        ]);
    }
}
