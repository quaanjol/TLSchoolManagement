<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\_CONST;
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

class PostController extends Controller
{
    // 
    public function all() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả bài đăng", "english" => "Dashboard"];
        $posts = Post::orderBy('id', 'DESC')->get();
        $event_post_category = _CONST::EVENT_POST_CATEGORY;

        return view('admin.web.post.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'posts' => $posts,
            'event_post_category' => $event_post_category
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
        $heading = ["vietnamese" => "Tạo mới bài đăng", "english" => "Dashboard"];
        $postCategories = PostCategory::all();

        return view('admin.web.post.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'postCategories' => $postCategories
        ]);
    }

    public function store(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee_id = $user->Employee->id;
        $post_category_id = $request->post_category_id;
        $title = $request->title;
        $description = $request->description;
        $event_date = $request->event_date;

        // handle image upload
        $name = '';
        $cover_path = '';
        if ($request->hasFile('img')) {
            $name = basename($request->file('img')->getClientOriginalName(), '.' . $request->file('img')->getClientOriginalExtension());
            $imgExtension = $request->file('img')->getClientOriginalExtension();
            $imgName = $name . "_" . time() . "." . $imgExtension;
            $request->img->move(public_path("image_upload/"), $imgName);
            $cover_path = "image_upload/" . $imgName;
        }

        $newsPost = new Post();
        $newsPost->employee_id = $employee_id;
        $newsPost->post_category_id = $post_category_id;
        $newsPost->title = $title;
        $newsPost->description = $description;
        $newsPost->event_date = $event_date;
        $newsPost->img = $cover_path;
        $newsPost->viewCount = 0;

        $newsPost->save();

        $noti = 'Thêm thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/post/all');
    }

    public function update($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $post = Post::find($id);
        if($post == null) {
            $noti = 'Lỗi. Bài đăng không tồn lại';
            $request->session()->flash('danger', $noti);
            return redirect()->back();
        }
        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa bài đăng", "english" => "Dashboard"];
        $postCategories = PostCategory::all();
        
        return view('admin.web.post.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'post' => $post,
            'postCategories' => $postCategories
        ]);
    }

    public function storeUpdate(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $newsPost = Post::find($id);
        if($newsPost == null) {
            $noti = 'Lỗi. Bài đăng không tồn lại';
            $request->session()->flash('danger', $noti);
            return redirect()->back();
        }

        $employee_id = $user->Employee->id;
        $post_category_id = $request->post_category_id;
        $title = $request->title;
        $description = $request->description;
        $event_date = $request->event_date;

        // handle image upload
        $name = '';
        $cover_path = '';
        if ($request->hasFile('img')) {
            $name = basename($request->file('img')->getClientOriginalName(), '.' . $request->file('img')->getClientOriginalExtension());
            $imgExtension = $request->file('img')->getClientOriginalExtension();
            $imgName = $name . "_" . time() . "." . $imgExtension;
            $request->img->move(public_path("image_upload/"), $imgName);
            $cover_path = "image_upload/" . $imgName;
        }

        $newsPost->employee_id = $employee_id;
        $newsPost->post_category_id = $post_category_id;
        $newsPost->title = $title;
        $newsPost->description = $description;
        $newsPost->event_date = $event_date;
        if($cover_path != '') {
            $newsPost->img = $cover_path;
        }
        
        $newsPost->save();

        $noti = 'Chỉnh sửa thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/post/all');
    }

    public function destroy(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $post = Post::find($id);
        if($post != null) {
            $post->delete();
            $noti = 'Xoá thành công.';
            $request->session()->flash('success', $noti);
            return redirect('/admin/post/all');
        } else {
            $noti = 'Xoá không thành công.';
            $request->session()->flash('danger', $noti);
            return redirect('/admin/post/all');
        }
    }
}
