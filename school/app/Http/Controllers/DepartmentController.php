<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use App\Http\Controllers\_CONST;

class DepartmentController extends Controller
{
    // 
    public function allDepartments() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả khoa", "english" => "Dashboard"];
        $departments = Department::orderBy('id', 'DESC')->get();

        return view('admin.web.department.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'departments' => $departments,
        ]);
    }

    // parents section

    // create & update employee
    public function createDepartment() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới khoa", "english" => "Dashboard"];

        return view('admin.web.department.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
        ]);
    }

    public function storeDepartment(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $eName = $request->name;
        $description = $request->description;

        $department = new Department();
        $department->name = $eName;
        $department->description = $description;
        
        $department->save();

        $noti = 'Thêm thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/department/all');
    }

    public function updateDepartment($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $department = Department::find($id);
        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa sinh viên", "english" => "Dashboard"];
        
        return view('admin.web.department.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'department' => $department
        ]);
    }

    public function storeUpdateDepartment(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $department = Department::find($id);

        $eName = $request->name;
        $description = $request->description;

        $department->name = $eName;
        $department->description = $description;
        
        $department->save();

        $noti = 'Chỉnh sửa thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/department/all');
    }

    public function destroy(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $department = department::find($id);
        if($department != null) {
            if($department->Students->count() != 0 || $department->Employees->count() != 0) {
                $noti = 'Xoá không thành công do vẫn còn sinh viên hoặc nhân viên trực thuộc khoa.';
                $request->session()->flash('danger', $noti);
                return redirect('/admin/department/all');
            } else {
                $department->delete();
                $noti = 'Xoá thành công.';
                $request->session()->flash('success', $noti);
                return redirect('/admin/department/all');
            }
        } else {
            $noti = 'Xoá không thành công.';
            $request->session()->flash('danger', $noti);
            return redirect('/admin/department/all');
        }
    }
}
