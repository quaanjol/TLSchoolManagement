<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use App\Http\Controllers\_CONST;

class SubjectController extends Controller
{
    // 
    public function all() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả môn học", "english" => "Dashboard"];
        $subjects = Subject::orderBy('id', 'DESC')->paginate(6);

        foreach($subjects as $subject) {
            $departments = [];
            foreach(unserialize($subject->departments) as $key => $value) {
                $departments[] = Department::find($value)->name;
            }
            $subject->departments = $departments;
        }

        return view('admin.web.subject.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'subjects' => $subjects,
        ]);
    }

    public function create() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới môn học", "english" => "Dashboard"];
        $departments = Department::orderBy('id', 'DESC')->get();

        return view('admin.web.subject.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'departments' => $departments,
        ]);
    }

    public function store(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $eName = $request->name;
        $code = $request->code;
        $description = $request->description;
        $credit = $request->credit;
        $departments = $request->departments;
        // dd($departments);

        $subject = new Subject();
        $subject->name = $eName;
        $subject->code = $code;
        $subject->description = $description;
        $subject->credit = $credit;
        $subject->departments = serialize($departments);

        $subject->save();

        $noti = 'Thêm thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/subject/all');
    }

    public function update($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $subject = Subject::find($id);

        if($subject == null) {
            return redirect('admin/subject/all');
        }

        $departmentNames = [];
        foreach(unserialize($subject->departments) as $key => $value) {
            $departmentNames[] = Department::find($value)->name;
        }
        $subject->departments = $departmentNames;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa môn học", "english" => "Dashboard"];
        $departments = Department::orderBy('id', 'DESC')->get();

        return view('admin.web.subject.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'subject' => $subject,
            'departments' => $departments,
        ]);
    }

    public function storeUpdate(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $subject = Subject::find($id);

        if($subject == null) {
            return redirect()->back();
        }

        $eName = $request->name;
        $code = $request->code;
        $description = $request->description;
        $credit = $request->credit;
        $departments = $request->departments;

        $subject->name = $eName;
        $subject->code = $code;
        $subject->description = $description;
        $subject->credit = $credit;
        $subject->departments = serialize($departments);

        $subject->save();

        $noti = 'Chỉnh sửa thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/subject/all');
    }

    public function destroy(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $subject = Subject::find($id);
        if($subject != null) {
            if($subject->Courses->count() > 0) {
                $noti = 'Xoá không thành công do vẫn còn khoá học trực thuộc môn học này.';
                $request->session()->flash('danger', $noti);
                return redirect('/admin/subject/all');
            } else {
                $subject->delete();

                $noti = 'Xoá thành công.';
                $request->session()->flash('success', $noti);
                return redirect('/admin/subject/all');
            }
        } else {
            $noti = 'Xoá không thành công.';
            $request->session()->flash('danger', $noti);
            return redirect('/admin/subject/all');
        }
    }
}
