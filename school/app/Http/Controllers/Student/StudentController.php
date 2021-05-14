<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Student;
use App\Models\ParentSchool;
use App\Models\Subject;
use App\Models\Course;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Attendance;
use App\Models\FinalGrade;
use App\Models\Grade;

class StudentController extends Controller
{
    // show
    public function show() {
        $user = auth()->user();
        if($user == null || $user->role_id != 5) {
            return redirect('/login');
        }

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tổng quan", "english" => "Dashboard"];
        $student = $user->student;

        // get dashboard information
        $departments = Department::all();
        $teachers = Employee::where('type', '=', 'teacher')->get();
        $subjects = Subject::all();
        $courses = Course::all();

        return view('student.web.dashboard')->with([
            'user' => $user,
            'theme' => $theme,
            'heading' => $heading,
            'student' => $student,
            'departments' => $departments,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'courses' => $courses,
        ]);
    }

    // change theme
    public function changeTheme($color)
    {
        $user = auth()->user();
        if($user == null) {
            return redirect('/login');
        }
        
        $u = User::find($user->id);
        $u->theme = $color;
        $u->save();
        return redirect()->back();
    }

    // profile
    public function profile() {
        $user = auth()->user();
        if($user == null) {
            return redirect('/login');
        }

        $theme = $user->theme;
        $heading = ["vietnamese" => "Trang cá nhân", "english" => "Profile"];

        $user = User::find($user->id);
        $employee = $user->Employee;

        return view('admin.web.profile')->with([
            'user' => $user,
            'theme' => $theme,
            'heading' => $heading,
            'employee' => $employee,
        ]);
    }

    public function profileStore(Request $request) {
        $user = auth()->user();
        if($user == null) {
            return redirect('/login');
        }
        if($user->role == 'admin') {
            // return to admin dashboard instead
        }

        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $password2 = $request->password2;
        
        $img = $request->avatar;
        
        $imageUrl = '';
        if($img != null) {
            // call service to upload image to imgur.com
            $imageUrl = ImgurService::uploadImage($img->getRealPath());
            // save your $imageUrl to DB if need
        }

        $user = User::find($user->id);
        $user->name = $name;
        $user->email = $email;
        if($user->role->name == 'Quản trị viên') {
            $role = 'admin';
        } elseif($user->role->name == 'Giảng viên') {
            $role = 'teacher';
        } elseif($user->role->name == 'Phụ huynh') {
            $role = 'parent';
        } elseif($user->role->name == 'Sinh viên') {
            $role = 'student';
        }

        if($imageUrl != '') {
            $user->avatar = $imageUrl;
        }
        if($password != null && $password2 != null && $password == $password2) {
            $user->password = bcrypt($password);
        }

        $user->save();
        $noti = 'Chỉnh sửa thành công.';

        $request->session()->flash('success', $noti);
        return redirect($role . '/profile');
    }
}
