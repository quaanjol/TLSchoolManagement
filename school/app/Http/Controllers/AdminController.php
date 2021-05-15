<?php

namespace App\Http\Controllers;

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
use App\Http\Controllers\_CONST;

class AdminController extends Controller
{
    // show
    public function show() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tổng quan", "english" => "Dashboard"];
        $employee = $user->Employee;

        // get dashboard information
        $departments = Department::all();
        $teachers = Employee::where('type', '=', 'teacher')->get();
        $employees = Employee::where('type', '<>', 'teacher')->get();
        $students = Student::all();
        $parents = ParentSchool::all();
        $subjects = Subject::all();
        $courses = Course::all();
        $postCategories = PostCategory::all();
        $posts = Post::all();

        return view('admin.web.dashboard')->with([
            'user' => $user,
            'theme' => $theme,
            'heading' => $heading,
            'employee' => $employee,
            'departments' => $departments,
            'teachers' => $teachers,
            'employees' => $employees,
            'students' => $students,
            'parents' => $parents,
            'subjects' => $subjects,
            'courses' => $courses,
            'postCategories' => $postCategories,
            'posts' => $posts
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
