<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Attendance;
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

                if($course->employee_id != $teacher->id) {
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

                    $classCount = Attendance::where('course_id', '=', $id)->get()->count() / count($students);

                    return view('teacher.web.course.manage')->with([
                        'user' => $user,
                        'teacher' => $teacher,
                        'students' => $students,
                        'theme' => $theme,
                        'heading' => $heading,
                        'course' => $course,
                        'classCount' => $classCount
                    ]);
                }
            }
        }
    }

    // check attendance
    public function checkAttendance(Request $request, $id) {
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
            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                
                $attendance = $request->attendance;
                $absence = $request->absence;
                
                if(count($attendance) > 0) {
                    foreach($attendance as $att) {
                        $thisAtt = new Attendance();
                        $thisAtt->course_id = $id;
                        $thisAtt->student_id = $att;
                        $thisAtt->date = date('Y-m-d');
                        $thisAtt->absence = 0;
                        $thisAtt->save();
                    }
                }

                if(count($absence) > 0) {
                    foreach($absence as $abs) {
                        $thisAtt = new Attendance();
                        $thisAtt->course_id = $id;
                        $thisAtt->student_id = $abs;
                        $thisAtt->date = date('Y-m-d');
                        $thisAtt->absence = 1;
                        $thisAtt->save();
                    }
                }

                return redirect()->back();
            }
        }
    }

    // add grade
    public function addGrade(Request $request, $id) {
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
            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                $allStudents = Student::all();

                $students = [];
                foreach($allStudents as $student)  {
                    if($student->checkRegisteredCourse($course->id) == true) {
                        $students[] = $student;
                    }
                }

                $name = $request->name;
                // dd($name);
                $index = 0;

                if($name == 'Giữa kì') {
                    $index = 30;
                } elseif($name == 'Cuối kì') {
                    $index = 60;
                }

                foreach($students as $student) {
                    $gradeInput = 'grade_' . $student->id;
                    $gradeValue = $request->$gradeInput;

                    $grade = Grade::where([
                        ['course_id', '=', $id],
                        ['student_id', '=', $student->id],
                        ['name', '=', $name]
                    ])->limit(1)->get();

                    if(!isset($grade[0])) {
                        $grade = new Grade();
                    } else {
                        $grade = $grade[0];
                    }

                    // dd($grade);

                    $grade->course_id = $id;
                    $grade->student_id = $student->id;
                    $grade->grade = $gradeValue;
                    $grade->name = $name;
                    $grade->index = $index;
                    $grade->save();
                }
            }

            $noti = 'Thêm điểm thành công.';
            $request->session()->flash('success', $noti);
            return redirect()->back();
        }
    }
}
