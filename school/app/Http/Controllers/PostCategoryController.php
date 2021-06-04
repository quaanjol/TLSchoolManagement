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

class PostCategoryController extends Controller
{
    // 
    public function all() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả thể loại bài đăng", "english" => "Dashboard"];
        $postCategories = PostCategory::orderBy('id', 'DESC')->get();

        return view('admin.web.postCategory.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'postCategories' => $postCategories,
        ]);
    }

    // create & update employee
    public function create() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới thể loại", "english" => "Dashboard"];

        return view('admin.web.postCategory.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
        ]);
    }

    public function store(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $eName = $request->name;
        $description = $request->description;

        $category = new PostCategory();
        $category->name = $eName;
        $category->description = $description;
        
        $category->save();

        $noti = 'Thêm thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/post-category/all');
    }

    public function update($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $category = PostCategory::find($id);
        if($category == null) {
            $noti = 'Lỗi. Thể loại không tồn lại';
            $request->session()->flash('danger', $noti);
            return redirect()->back();
        }
        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa thể loại", "english" => "Dashboard"];
        
        return view('admin.web.postCategory.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'category' => $category
        ]);
    }

    public function storeUpdate(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $category = PostCategory::find($id);
        if($category == null) {
            $noti = 'Lỗi. Thể loại không tồn lại';
            $request->session()->flash('danger', $noti);
            return redirect()->back();
        }

        $eName = $request->name;
        $description = $request->description;

        $category->name = $eName;
        $category->description = $description;
        
        $category->save();

        $noti = 'Chỉnh sửa thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/post-category/all');
    }

    // public function destroy(Request $request, $id) {
    //     $user = auth()->user();
    //     if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
    //         return redirect('/login');
    //     }

    //     $department = department::find($id);
    //     if($department != null) {
    //         if($department->Students->count() != 0 || $department->Employees->count() != 0) {
    //             $noti = 'Xoá không thành công do vẫn còn sinh viên hoặc nhân viên trực thuộc khoa.';
    //             $request->session()->flash('danger', $noti);
    //             return redirect('/admin/department/all');
    //         } else {
    //             $department->delete();
    //             $noti = 'Xoá thành công.';
    //             $request->session()->flash('success', $noti);
    //             return redirect('/admin/department/all');
    //         }
    //     } else {
    //         $noti = 'Xoá không thành công.';
    //         $request->session()->flash('danger', $noti);
    //         return redirect('/admin/department/all');
    //     }
    // }
}
