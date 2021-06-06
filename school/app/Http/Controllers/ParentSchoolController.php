<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ParentSchool;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use App\Http\Controllers\_CONST;

class ParentSchoolController extends Controller
{
    // 
    public function allParentSchools() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả phụ huynh", "english" => "Dashboard"];
        $parentSchools = ParentSchool::orderBy('id', 'DESC')->paginate(6);

        return view('admin.web.parentSchool.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'parentSchools' => $parentSchools,
        ]);
    }

    // parents section

    // create & update employee
    public function createParentSchool() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới phụ huynh", "english" => "Dashboard"];
        $students = Student::orderBy('id', 'DESC')->get();

        return view('admin.web.parentSchool.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'students' => $students
        ]);
    }

    public function storeParentSchool(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $eName = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;

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

        $parentSchool = new ParentSchool();
        $parentSchool->name = $eName;
        $parentSchool->email = $email;
        $parentSchool->phone = $phone;
        $parentSchool->address = $address;
        $parentSchool->gender = $gender;
        if($cover_path != '') {
            $parentSchool->img = $cover_path;
        } else {
            if($gender == 1) {
                $parentSchool->img = 'https://i.imgur.com/jJ4Iy9p.png';
            } else {
                $parentSchool->img = 'https://i.imgur.com/YWhjr9n.png';
            }
        }

        $newUser = new User();
        $newUser->name = $eName;

        // define this user as a parent
        $newUser->role_id = _CONST::PARENT_ROLE_ID;
        $newUser->username = $eName;
        $newUser->email = $email;
        $newUser->title = "";
        $newUser->theme = "danger";
        $newUser->password = bcrypt("parent123");

        try {
            $newUser->save();

            $parentSchool->user_id = $newUser->id;
            $parentSchool->save();

            $noti = 'Thêm thành công. Để phụ huynh mới login, dùng email của phụ huynh đó với password "parent123"';
            $request->session()->flash('success', $noti);
            return redirect('admin/parent/all');
        } catch(\Exception $e) {
            $request->session()->flash('danger', $e->getMessage());
            return back();
        }
    }

    public function updateParentSchool($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $thisParent = ParentSchool::find($id);

        if($thisParent == null) {
            return redirect('admin/parent/all');
        }

        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa phụ huynh", "english" => "Dashboard"];

        return view('admin.web.parentSchool.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'thisParent' => $thisParent
        ]);
    }

    public function storeUpdateParentSchool(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $parentSchool = ParentSchool::find($id);
        $newUser = User::find($parentSchool->user_id);

        if($parentSchool == null) {
            return redirect()->back();
        }

        $eName = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;

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

        $parentSchool->name = $eName;
        $parentSchool->email = $email;
        $parentSchool->phone = $phone;
        $parentSchool->address = $address;
        $parentSchool->gender = $gender;
        if($cover_path != '') {
            $parentSchool->img = $cover_path;
        }

        $newUser->name = $eName;

        // define this user as a parent
        $newUser->role_id = _CONST::PARENT_ROLE_ID;
        $newUser->email = $email;

        try {
            $newUser->save();
            $parentSchool->save();

            $noti = 'Chỉnh sửa thành công.';
            $request->session()->flash('success', $noti);
            return redirect('admin/parent/all');
        } catch(\Exception $e) {
            $request->session()->flash('danger', $e->getMessage());
            return back();
        }
    }

    public function destroy(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $parentSchool = ParentSchool::find($id);
        if($parentSchool != null) {
            $thisUser = User::find($parentSchool->user_id);
            if($thisUser != null) {
                $thisUser->delete();
            }
            $parentSchool->delete();

            $ownedStudents = Student::where('parent_school_id', '=', $parentSchool->id)->get();

            if($ownedStudents->count() > 0) {
                foreach($ownedStudents as $student) {
                    $student->parent_school_id = null;
                    $student->save();
                }
            }

            $noti = 'Xoá thành công.';
            $request->session()->flash('success', $noti);
            return redirect('/admin/parent/all');
        } else {
            $noti = 'Xoá không thành công.';
            $request->session()->flash('danger', $noti);
            return redirect('/admin/parent/all');
        }
    }
}
