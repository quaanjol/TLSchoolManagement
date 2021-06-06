<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeachersImport;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\_CONST;

class EmployeeController extends Controller
{
    // 
    public function allAdministrators() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả quản trị viên", "english" => "Dashboard"];
        $administrators = Employee::where('type' , '=', 'employee')->paginate(6);

        return view('admin.web.administrator.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'administrators' => $administrators,
        ]);
    }

    // create & update employee
    public function createEmployee() {
        $user = auth()->user();
        if($user == null || $user->role_id != _CONST::ADMIN_ROLE_ID) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới quản trị viên", "english" => "Dashboard"];
        $departments = Department::all();

        return view('admin.web.administrator.create')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'departments' => $departments
        ]);
    }

    public function storeEmployee(Request $request) {
        $user = auth()->user();
        if($user == null || $user->role_id != _CONST::ADMIN_ROLE_ID) {
            return redirect('/login');
        }

        $eName = $request->name;
        $department_id = $request->department_id;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;
        $dob = $request->dob;
        $doj = $request->doj;
        $status = $request->status;
        $role_id = $request->role_id;

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

        $employee = new Employee();
        $employee->name = $eName;
        $employee->type = 'employee';
        $employee->department_id = $department_id;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->address = $address;
        $employee->gender = $gender;
        $employee->dob = $dob;
        $employee->doj = $doj;
        $employee->status = $status;
        if($cover_path != '') {
            $employee->img = $cover_path;
        } else {
            if($gender == 1) {
                $employee->img = 'https://i.imgur.com/jJ4Iy9p.png';
            } else {
                $employee->img = 'https://i.imgur.com/YWhjr9n.png';
            }
        }

        $newUser = new User();
        $newUser->name = $eName;

        $newUser->role_id = $role_id;
        $newUser->username = $eName . $dob;
        $newUser->email = $email;
        $newUser->title = "";
        $newUser->theme = "danger";
        $newUser->password = bcrypt("admin123");

        try {
            $newUser->save();
            $employee->user_id = $newUser->id;
            $employee->save();

            $noti = 'Thêm thành công. Để nhân viên mới login, dùng email của nhân viên đó với password "admin123"';
            $request->session()->flash('success', $noti);
            return redirect('admin/administrator/all');
        } catch(\Exception $e) {
            $request->session()->flash('danger', $e->getMessage());
            return back();
        } 
    }

    public function updateEmployee($id) {
        $user = auth()->user();
        if($user == null || $user->role_id != _CONST::ADMIN_ROLE_ID) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $thisAdmin = Employee::find($id);

        if($thisAdmin == null) {
            return redirect()->back();
        }

        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa quản trị viên", "english" => "Dashboard"];
        $departments = Department::all();

        return view('admin.web.administrator.update')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'departments' => $departments,
            'thisAdmin' => $thisAdmin
        ]);
    }

    public function storeUpdateEmployee(Request $request, $id) {
        $user = auth()->user();
        if($user == null || $user->role_id != _CONST::ADMIN_ROLE_ID) {
            return redirect('/login');
        }

        $employee = Employee::find($id);

        if($employee == null || $employee->type != 'employee') {
            return redirect()->back();
        }

        $eName = $request->name;
        $department_id = $request->department_id;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;
        $dob = $request->dob;
        $doj = $request->doj;
        $status = $request->status;
        $role_id = $request->role_id;

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

        $employee->name = $eName;
        $employee->department_id = $department_id;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->address = $address;
        $employee->gender = $gender;
        $employee->dob = $dob;
        $employee->doj = $doj;
        $employee->status = $status;
        if($cover_path != '') {
            $employee->img = $cover_path;
        }

        $newUser = User::find($employee->user_id);
        $newUser->name = $eName;

        // define this user as an admin
        $newUser->role_id = $role_id;
        $newUser->email = $email;

        try {
            $newUser->save();
            $employee->save();

            $noti = 'Chỉnh sửa thành công.';
            $request->session()->flash('success', $noti);
            return redirect('admin/administrator/all');
        } catch(\Exception $e) {
            $request->session()->flash('danger', $e->getMessage());
            return back();
        } 
    }

    // teachers section
    public function allTeachers() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả giảng viên", "english" => "Dashboard"];
        $teachers = Employee::where('type' , '=', 'teacher')->paginate(6);

        return view('admin.web.teacher.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'teachers' => $teachers,
        ]);
    }

    // create & update employee
    public function createTeacher() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới giảng viên", "english" => "Dashboard"];
        $departments = Department::all();

        return view('admin.web.teacher.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'departments' => $departments
        ]);
    }

    public function storeTeacher(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $eName = $request->name;
        $department_id = $request->department_id;
        $title = $request->title;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;
        $dob = $request->dob;
        $doj = $request->doj;
        $status = $request->status;

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

        $employee = new Employee();
        $employee->name = $eName;
        $employee->type = 'teacher';
        $employee->department_id = $department_id;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->address = $address;
        $employee->gender = $gender;
        $employee->dob = $dob;
        $employee->doj = $doj;
        $employee->status = $status;
        if($cover_path != '') {
            $employee->img = $cover_path;
        } else {
            if($gender == 1) {
                $employee->img = 'https://i.imgur.com/jJ4Iy9p.png';
            } else {
                $employee->img = 'https://i.imgur.com/YWhjr9n.png';
            }
        }

        $newUser = new User();
        $newUser->name = $eName;

        // define this user as a teacher
        $newUser->role_id = _CONST::TEACHER_ROLE_ID;
        $newUser->username = $eName . $dob;
        $newUser->title = $title;
        $newUser->email = $email;
        $newUser->title = $title;
        $newUser->theme = "danger";
        $newUser->password = bcrypt("teacher123");

        try {
            $newUser->save();

            $employee->user_id = $newUser->id;
            $employee->save();

            $noti = 'Thêm thành công. Để giáo viên mới login, dùng email của giáo viên đó với password "teacher123"';
            $request->session()->flash('success', $noti);
            return redirect('admin/teacher/all');
        } catch(\Exception $e) {
            $request->session()->flash('danger', $e->getMessage());
            return back();
        } 
    }

    public function updateTeacher($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $thisTeacher = Employee::find($id);
        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa giảng viên", "english" => "Dashboard"];
        $departments = Department::all();

        return view('admin.web.teacher.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'departments' => $departments,
            'thisTeacher' => $thisTeacher
        ]);
    }

    public function storeUpdateTeacher(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = Employee::find($id);
        $newUser = User::find($employee->user_id);

        if($employee == null || $employee->type != 'teacher') {
            return redirect()->back();
        }

        $eName = $request->name;
        $department_id = $request->department_id;
        $title = $request->title;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;
        $dob = $request->dob;
        $doj = $request->doj;
        $status = $request->status;

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

        $employee->name = $eName;
        $employee->department_id = $department_id;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->address = $address;
        $employee->gender = $gender;
        $employee->dob = $dob;
        $employee->doj = $doj;
        $employee->status = $status;
        if($cover_path != '') {
            $employee->img = $cover_path;
        }

        $newUser->name = $eName;

        // define this user as a teacher
        $newUser->role_id = _CONST::TEACHER_ROLE_ID;
        $newUser->title = $title;
        $newUser->email = $email;


        try {
            $newUser->save();
            $employee->save();

            $noti = 'Chỉnh sửa thành công.';
            $request->session()->flash('success', $noti);
            return redirect('admin/teacher/all');
        } catch(\Exception $e) {
            $request->session()->flash('danger', $e->getMessage());
            return back();
        }
    }

    public function destroy(Request $request, $id) {
        $user = auth()->user();
        if($user == null || $user->role_id != _CONST::ADMIN_ROLE_ID) {
            return redirect('/login');
        }

        $employee = Employee::find($id);
        if($employee != null) {
            $thisUser = User::find($employee->user_id);
            if($thisUser != null) {
                $thisUser->delete();
            }
            $employee->delete();
            $noti = 'Xoá thành công.';
            $request->session()->flash('success', $noti);
            return redirect('/admin/administrator/all');
        } else {
            $noti = 'Xoá không thành công.';
            $request->session()->flash('danger', $noti);
            return redirect('/admin/administrator/all');
        }
    }

    // import
    public function importTeacher(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Import file giảng viên", "english" => "Dashboard"];
        $departments = Department::orderBy('id', 'DESC')->get();
        return view('admin.web.teacher.import')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'departments' => $departments,
        ]);
    }

    public function storeImportTeacher(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        if(!$request->file) {
            $request->session()->flash('danger', 'Import file không thành công.');
            return back();
        }

        try {
            Excel::import(new TeachersImport, $request->file);
            $request->session()->flash('success', 'Import file thành công.');
            return back();
        } catch(\Exception $e) {
            $request->session()->flash('danger', $e->getMessage());
            return back();
        }
    }
}
