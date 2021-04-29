<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ParentSchool;
use App\Models\Student;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // 
    public function allStudents() {
        $user = auth()->user();
        if($user == null || ($user->role_id != 1 && $user->role_id != 2)) {
            return redirect('/login');
        }

        $employee = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả sinh viên", "english" => "Dashboard"];
        $students = Student::orderBy('id', 'DESC')->get();

        return view('admin.web.student.list')->with([
            'user' => $user,
            'employee' => $employee,
            'theme' => $theme,
            'heading' => $heading,
            'students' => $students,
        ]);
    }

    // parents section

    // create & update employee
    public function createStudent() {
        $user = auth()->user();
        if($user == null || ($user->role_id != 1 && $user->role_id != 2)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $theme = $user->theme;
        $heading = ["vietnamese" => "Tạo mới sinh viên", "english" => "Dashboard"];
        $departments = Department::orderBy('id', 'DESC')->get();
        $parentSchools = ParentSchool::orderBy('id', 'DESC')->get();

        return view('admin.web.student.create')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'departments' => $departments,
            'parentSchools' => $parentSchools
        ]);
    }

    public function storeStudent(Request $request) {
        $user = auth()->user();
        if($user == null || ($user->role_id != 1 && $user->role_id != 2)) {
            return redirect('/login');
        }

        $eName = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;
        $dob = $request->dob;
        $syear = $request->syear;
        $status = $request->status;
        $department_id = $request->department_id;
        $parent_school_id = $request->parent_school_id;
        // dd($email);

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

        $student = new Student();
        $student->name = $eName;
        $student->email = $email;
        $student->phone = $phone;
        $student->address = $address;
        $student->gender = $gender;
        $student->dob = $dob;
        $student->syear = $syear;
        $student->status = $status;
        $student->department_id = $department_id;
        $student->parent_school_id = $parent_school_id;
        if($cover_path != '') {
            $student->img = $cover_path;
        } else {
            if($gender == 1) {
                $student->img = 'https://i.imgur.com/jJ4Iy9p.png';
            } else {
                $student->img = 'https://i.imgur.com/YWhjr9n.png';
            }
        }

        $newUser = new User();
        $newUser->name = $eName;

        // define this user as a teacher
        $newUser->role_id = 5;
        $newUser->username = $eName;
        $newUser->email = $email;
        $newUser->title = "";
        $newUser->theme = "danger";
        $newUser->password = bcrypt("student123");

        $this->validate($request, [
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        // dd($user);

        $newUser->save();

        $student->user_id = $newUser->id;
        $student->save();

        $noti = 'Thêm thành công. Để sinh viên mới login, dùng email của sinh viên đó với password "student123"';
        $request->session()->flash('success', $noti);
        return redirect('admin/student/all');
    }

    public function updateStudent($id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != 1 && $user->role_id != 2)) {
            return redirect('/login');
        }

        $employee = $user->Employee;
        $thisStudent = Student::find($id);
        $theme = $user->theme;
        $heading = ["vietnamese" => "Chỉnh sửa sinh viên", "english" => "Dashboard"];
        $departments = Department::orderBy('id', 'DESC')->get();
        $parentSchools = ParentSchool::orderBy('id', 'DESC')->get();

        return view('admin.web.student.update')->with([
            'user' => $user,
            'theme' => $theme,
            'employee' => $employee,
            'heading' => $heading,
            'thisStudent' => $thisStudent,
            'departments' => $departments,
            'parentSchools' => $parentSchools
        ]);
    }

    public function storeUpdateStudent(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != 1 && $user->role_id != 2)) {
            return redirect('/login');
        }

        $student = Student::find($id);
        $newUser = User::find($student->user_id);

        if($student == null) {
            return redirect()->back();
        }

        $eName = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $gender = $request->gender;
        $dob = $request->dob;
        $syear = $request->syear;
        $status = $request->status;
        $department_id = $request->department_id;
        $parent_school_id = $request->parent_school_id;

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

        $student->name = $eName;
        $student->email = $email;
        $student->phone = $phone;
        $student->address = $address;
        $student->gender = $gender;
        $student->dob = $dob;
        $student->syear = $syear;
        $student->status = $status;
        $student->department_id = $department_id;
        $student->parent_school_id = $parent_school_id;
        if($cover_path != '') {
            $student->img = $cover_path;
        }

        $newUser->name = $eName;

        // define this user as a parent
        $newUser->role_id = 5;
        $newUser->email = $email;

        // $this->validate($request, [
        //     'email' => [
        //         'required',
        //         Rule::unique('users')->ignore($user->id),
        //     ],
        // ]);

        $newUser->save();
        $student->save();

        $noti = 'Chỉnh sửa thành công.';
        $request->session()->flash('success', $noti);
        return redirect('admin/student/all');
    }

    public function destroy(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != 1 && $user->role_id != 2)) {
            return redirect('/login');
        }

        $student = Student::find($id);
        if($student != null) {
            $thisUser = User::find($student->user_id);
            if($thisUser != null) {
                $thisUser->delete();
            }
            $student->delete();

            $noti = 'Xoá thành công.';
            $request->session()->flash('success', $noti);
            return redirect('/admin/student/all');
        } else {
            $noti = 'Xoá không thành công.';
            $request->session()->flash('danger', $noti);
            return redirect('/admin/student/all');
        }
    }
}
