<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Http\Controllers\_CONST;

class CourseController extends Controller
{
    // 
    public function show() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::STUDENT_ROLE_ID)) {
            return redirect('/login');
        }

        $student = $user->Student;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả khoá học", "english" => "Dashboard"];
        // damn

        $todayDate = date('Y-m-d');
        $courses = Course::orderBy('id', 'DESC')->whereDate('start', '>', $todayDate)->paginate(6);

        return view('student.web.course.list')->with([
            'user' => $user,
            'student' => $student,
            'theme' => $theme,
            'heading' => $heading,
            'courses' => $courses,
        ]);
    }

    public function registeredCourses() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::STUDENT_ROLE_ID)) {
            return redirect('/login');
        }

        $student = $user->Student;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả khoá học đã đăng kí", "english" => "Dashboard"];
        $courses = Course::orderBy('id', 'DESC')->whereIn('id', unserialize($student->courses))->paginate(6);

        return view('student.web.course.registeredCourses')->with([
            'user' => $user,
            'student' => $student,
            'theme' => $theme,
            'heading' => $heading,
            'courses' => $courses,
        ]);
    }

    public function register(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::STUDENT_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('student/course/all');
        }

        $allStudents = Student::all();
        $registeredStudents = [];
        foreach($allStudents as $student) {
            if($student->checkRegisteredCourse($id) == true) {
                $registeredStudents[] = $student;
            }
        }

        if(count($registeredStudents) >= $course->quantity) {
                $noti = 'Khoá học không đuợc đăng kí vì đã đủ sinh viên.';
                $request->session()->flash('danger', $noti);
                return redirect('student/course/all');
        }

        
        $student = $user->Student;

        if($course->Subject->checkStudent($student->department_id) == false) {
            $noti = 'Khoá học không đuợc đăng kí vì khác khoa.';
            $request->session()->flash('danger', $noti);
            return redirect('student/course/all');
        }

        $registeredCourses = $student->courses;
        if($registeredCourses == null) {
            $registeredCourses = [];
            $registeredCourses[] = $id;
        } else {
            $registeredCourses = unserialize($registeredCourses);
            if(in_array($id, $registeredCourses)) {
                $noti = 'Khoá học đã được đăng kí.';
                $request->session()->flash('danger', $noti);
                return redirect('student/course/all');
            } else {
                $registeredCourses[] = $id;
            }
        }
        $student->courses = serialize($registeredCourses);
        $student->save();
        $noti = 'Đăng kí khoá học thành công.';
        $request->session()->flash('success', $noti);
        return redirect('student/course/all');
    }
}
