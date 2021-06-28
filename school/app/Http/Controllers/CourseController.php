<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Course;
use Illuminate\Validation\Rule;
use App\Http\Controllers\_CONST;
use App\Exports\CourseStudentsExport;
use App\Imports\GradesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

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

    // manage course
    public function manage(Request $request, $id, $slug) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if(Str::slug($course->name) != $slug) {
                $noti = 'Tên khoá học không hợp lệ.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                $employee = $user->Employee;

                $theme = $user->theme;
                $heading = ["vietnamese" => $course->name, "english" => "Dashboard"];

                $allStudents = $course->getAllStudents();

                foreach($allStudents as $student) {
                    if(!isset($student->getFinalGrade($id, $student->id)[0])) {
                        $student->result = null;
                        $student->resultBaseFour = null;
                        $student->rank = null;
                    } else {
                        $finalGrade = $student->getFinalGrade($id, $student->id)[0];
                        $student->result = $finalGrade->result;
                        $student->resultBaseFour = $finalGrade->resultBaseFour;

                        if ($finalGrade->rank == 1) {
                            $student->rank = "A";
                        } elseif($finalGrade->rank == 2) {
                            $student->rank = "B";
                        } elseif($finalGrade->rank == 3) {
                            $student->rank = "C";
                        } elseif($finalGrade->rank == 4) {
                            $student->rank = "D";
                        } elseif($finalGrade->rank == 5) {
                            $student->rank = "F";
                        }
                        
                    }
                }

                return view('admin.web.course.manage')->with([
                    'user' => $user,
                    'employee' => $employee,
                    'students' => $allStudents,
                    'theme' => $theme,
                    'heading' => $heading,
                    'course' => $course,
                ]);
            }
        }
    }

    public function reopenCourse(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::ADMIN_ROLE_ID && $user->role_id != _CONST::SUB_ADMIN_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            $employee = $user->Employee;

            $allStudents = $course->getAllStudents();

                $check = true;
                $errorStudent = null;

                foreach($allStudents as $student) {
                    if(!$student->checkMidTermGrade($course->id) || !$student->checkLastTermGrade($course->id)) {
                        $check = false;
                        $errorStudent = $student;
                        break;
                    }
                }

                if($check == false) {
                    $noti = 'Không thể kết thúc khoá học vì sinh viên ' . $errorStudent->name . ' chưa có điểm giữa kì hoặc cuối kì.';
                    $request->session()->flash('warning', $noti);
                    return redirect()->back();
                } else {
                    try {
                        // reCalculateGpa
                        foreach($allStudents as $student) {
                            $finalGrade = $student->getFinalGrade($id, $student->id);

                            if(!isset($finalGrade[0])) {
                                $finalGrade = new FinalGrade();
                            } else {
                                $finalGrade = $finalGrade[0];
                            }

                            $finalGrade->course_id = $id;
                            $finalGrade->student_id = $student->id;

                            $attendanceGrade = ($student->getCourseAttendancesNotAbsence($id)->count() * 1 + $student->getCourseAttendancesLate($id)->count() * 0.5) / $student->getCourseAttendances($id)->count();
                            $attendanceCount = 1;
                            $bonuses = $student->getBonusGrade($id, $student->id);
                            foreach($bonuses as $bonus) {
                                $attendanceGrade += $bonus->grade;
                                $attendanceCount++;
                            }

                            $attendanceGrade = $attendanceGrade / $attendanceCount;
                            $midTermGrade = $student->getMidTermGrade($id, $student->id);
                            $lastTermGrade = $student->getLastTermGrade($id, $student->id);

                            if(!isset($midTermGrade[0])) {
                                $noti = 'Không thể kết thúc khoá học vì sinh viên ' . $student->name . ' chưa có điểm giữa kì.';
                                $request->session()->flash('warning', $noti);
                                return redirect()->back();
                            } else {
                                $midTermGrade = $midTermGrade[0];
                            }

                            if(!isset($lastTermGrade[0])) {
                                $noti = 'Không thể kết thúc khoá học vì sinh viên ' . $student->name . ' chưa có điểm cuối kì.';
                                $request->session()->flash('warning', $noti);
                                return redirect()->back();
                            } else {
                                $lastTermGrade = $lastTermGrade[0];
                            }

                            $result  = ($attendanceGrade * 10 + $midTermGrade->grade * 30 + $lastTermGrade->grade * 60) / 100;
                            $resultBaseFour = $result / 2.5;

                            //8.5 – 10	A
                            //7.0 – 8.4	B
                            //5.5 - 6.9 C
                            //4.0 - 6.4 D
                            //4.0-- F

                            $rank = "F";
                            if($result >= 8.5 && $result <= 10) {
                                $rank = 1;
                            } elseif($result >= 7.0 && $result < 8.5) {
                                $rank = 2;
                            } elseif($result >= 5.5 && $result < 7) {
                                $rank = 3;
                            } elseif($result >= 4.0 && $result < 5.5) {
                                $rank = 4;
                            } elseif($result < 4.0) {
                                $rank = 5;
                            }
                            $finalGrade->result = $result;
                            $finalGrade->resultBaseFour = $resultBaseFour;
                            $finalGrade->rank = $rank;
                            $finalGrade->save();

                            $student->reCalculateGpa();
                        }

                        $course->status = 1;
                        $course->save();
                        $noti = 'Mở lại khoá học thành công. Giảng viên có thể thay đổi kết quả khoá học.';
                        $request->session()->flash('success', $noti);
                        return redirect()->back();
                    } catch(\Exceptio $e) {
                        $noti = $e->getMessage();
                        $request->session()->flash('danger', $noti);
                        return redirect()->back();
                    }
                }
        }
    }
}
