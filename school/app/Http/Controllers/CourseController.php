<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Course;
use Illuminate\Validation\Rule;
use App\Http\Controllers\_CONST;

class CourseController extends Controller
{
    // 
    public function all() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả khoá học", "english" => "Dashboard"];
        $courses = Course::orderBy('id', 'DESC')->paginate(6);

        // foreach($subjects as $subject) {
        //     $departments = [];
        //     foreach(unserialize($subject->departments) as $key => $value) {
        //         $departments[] = Department::find($value)->name;
        //     }
        //     $subject->departments = $departments;
        // }

        return view('admin.web.course.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'courses' => $courses,
        ]);
    }

    public function view($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Thông tin khoá học", "english" => "Dashboard"];
        $course = Course::find($id);

        return view('admin.web.course.view')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'course' => $course,
        ]);
    }

    public function create() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới khoá học", "english" => "Dashboard"];
        $subjects = Subject::orderBy('id', 'DESC')->get();
        $teachers = Employee::orderBy('id', 'DESC')->where('type', '=', 'teacher')->get();

        return view('admin.web.course.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'subjects' => $subjects,
            'teachers' => $teachers
        ]);
    }

    public function store(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $eName = $request->name;
        $subject_id = $request->subject_id;
        $employee_id = $request->employee_id;
        $start = $request->start;
        $end = $request->end;
        $status = $request->status;
        $quantity = $request->quantity;

        $course = new Course();
        $course->name = $eName;
        $course->subject_id = $subject_id;
        $course->employee_id = $employee_id;
        $course->start = $start;
        $course->end = $end;
        $course->status = $status;
        $course->quantity = $quantity;

        $course->save();

        $noti = 'Thêm thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/course/all');
    }

    public function update($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $course = Course::find($id);
        $teachers = Employee::orderBy('id', 'DESC')->where('type', '=', 'teacher')->get();

        if($course == null) {
            return redirect('admin/course/all');
        }


        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa khoá học", "english" => "Dashboard"];
        $subjects = Subject::orderBy('id', 'DESC')->get();

        return view('admin.web.course.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'course' => $course,
            'subjects' => $subjects,
            'teachers' => $teachers
        ]);
    }

    public function storeUpdate(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            return redirect()->back();
        }

        $eName = $request->name;
        $subject_id = $request->subject_id;
        $employee_id = $request->employee_id;
        $start = $request->start;
        $end = $request->end;
        $status = $request->status;
        $quantity = $request->quantity;

        $course->name = $eName;
        $course->subject_id = $subject_id;
        $course->employee_id = $employee_id;
        $course->start = $start;
        $course->end = $end;
        $course->status = $status;
        $course->quantity = $quantity;

        $course->save();

        $noti = 'Chỉnh sửa thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/course/all');
    }

    public function destroy(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);
        if($course != null) {
            // handle delete courses here
            $noti = 'handle delete course here';
            $request->session()->flash('secodnary', $noti);
            return redirect('/admin/subject/all');
        } else {
            $noti = 'Xoá không thành công.';
            $request->session()->flash('danger', $noti);
            return redirect('/admin/subject/all');
        }
    }
}
