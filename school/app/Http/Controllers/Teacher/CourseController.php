<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Attendace;
use App\Http\Controllers\_CONST;

class CourseController extends Controller
{
    // 
    public function show() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $teacher = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả khoá học", "english" => "Dashboard"];

        $todayDate = date('Y-m-d');
        $courses = Course::orderBy('id', 'DESC')->whereDate('start', '>', $todayDate)->paginate(6);

        return view('teacher.web.course.list')->with([
            'user' => $user,
            'teacher' => $teacher,
            'theme' => $theme,
            'heading' => $heading,
            'courses' => $courses,
        ]);
    }

    // manage
    public function manage(Request $request, $id, $slug) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if(Str::slug($course->name) != $slug) {
                $noti = 'Tên khoá học không hợp lệ.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                $teacher = $user->Employee;
                
                if($course->teacher_id != $teacher->id) {
                    $noti = 'Khoá học không thuộc quản lý.';
                    $request->session()->flash('warning', $noti);
                    return redirect('teacher/course/all');
                } else {
                    $theme = $user->theme;
                    $heading = ["vietnamese" => $course->name, "english" => "Dashboard"];

                    $allStudents = Student::all();

                    $students = [];
                    foreach($allStudents as $student)  {
                        if($student->checkRegisteredCourse($course->id) == true) {
                            $students[] = $student;
                        }
                    }

                    return view('teacher.web.course.manage')->with([
                        'user' => $user,
                        'teacher' => $teacher,
                        'students' => $students,
                        'theme' => $theme,
                        'heading' => $heading,
                        'course' => $course,
                    ]);
                }
            }
        }
    }
}
