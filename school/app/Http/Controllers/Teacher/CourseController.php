<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Student;
use App\Models\Grade;
use App\Models\FinalGrade;
use App\Models\Attendance;
use App\Models\Attendace;
use App\Http\Controllers\_CONST;
use App\Exports\CourseStudentsExport;
use App\Imports\GradesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    // 
    public function show() {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $teacher = $user->Employee;

        $theme = $user->theme;
        $heading = ["vietnamese" => "Tất cả khoá học", "english" => "Dashboard"];

        $todayDate = date('Y-m-d');
        $courses = Course::orderBy('id', 'DESC')->whereDate('start', '>', $todayDate)->paginate(6);

        return view('teacher.web.course.list')->with([
            'user' => $user,
            'teacher' => $teacher,
            'theme' => $theme,
            'heading' => $heading,
            'courses' => $courses,
        ]);
    }

    // manage
    public function manage(Request $request, $id, $slug) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
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
                $teacher = $user->Employee;

                if($course->employee_id != $teacher->id) {
                    $noti = 'Khoá học không thuộc quản lý.';
                    $request->session()->flash('warning', $noti);
                    return redirect('teacher/course/all');
                } else {
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

                    return view('teacher.web.course.manage')->with([
                        'user' => $user,
                        'teacher' => $teacher,
                        'students' => $allStudents,
                        'theme' => $theme,
                        'heading' => $heading,
                        'course' => $course,
                        
                    ]);
                }
            }
        }
    }

    // check attendance
    public function checkAttendance(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                
                $attendance = $request->attendance;
                $absence = $request->absence;
                $late = $request->late;
                
                if($attendance != null && count($attendance) > 0) {
                    foreach($attendance as $att) {
                        $checks = Attendance::where([
                            ['course_id', '=', $id],
                            ['student_id', '=', $att],
                            ['date', '=', date('Y-m-d')]
                        ])->limit(1)->get();
    
                        if(!isset($checks[0])) {
                            $thisAtt = new Attendance();
                        } else {
                            $thisAtt = $checks[0];
                        }
                        // $thisAtt = new Attendance();
                        $thisAtt->course_id = $id;
                        $thisAtt->student_id = $att;
                        $thisAtt->date = date('Y-m-d');
                        $thisAtt->absence = 0;
                        $thisAtt->save();
                    }
                }

                if($absence != null && count($absence) > 0) {
                    foreach($absence as $abs) {
                        $checks = Attendance::where([
                            ['course_id', '=', $id],
                            ['student_id', '=', $abs],
                            ['date', '=', date('Y-m-d')]
                        ])->limit(1)->get();
    
                        if(!isset($checks[0])) {
                            $thisAtt = new Attendance();
                        } else {
                            $thisAtt = $checks[0];
                        }
                        // $thisAtt = new Attendance();
                        $thisAtt->course_id = $id;
                        $thisAtt->student_id = $abs;
                        $thisAtt->date = date('Y-m-d');
                        $thisAtt->absence = 1;
                        $thisAtt->save();
                    }
                }

                if($late != null && count($late) > 0) {
                    foreach($late as $lt) {
                        $checks = Attendance::where([
                            ['course_id', '=', $id],
                            ['student_id', '=', $lt],
                            ['date', '=', date('Y-m-d')]
                        ])->limit(1)->get();
    
                        if(!isset($checks[0])) {
                            $thisAtt = new Attendance();
                        } else {
                            $thisAtt = $checks[0];
                        }
                        // $thisAtt = new Attendance();
                        $thisAtt->course_id = $id;
                        $thisAtt->student_id = $lt;
                        $thisAtt->date = date('Y-m-d');
                        $thisAtt->absence = 2;
                        $thisAtt->save();
                    }
                }

                return redirect()->back();
            }
        }
    }

    public function updateAttendance(Request $request, $id, $course_id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $teacher = $user->Employee;

        $course = Course::find($course_id);
        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect()->back();
        }

        if($course->status == 0) {
            $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
            $request->session()->flash('warning', $noti);
            return redirect()->back();
        }

        if($course->employee_id != $teacher->id) {
            $noti = 'Khoá học không thuộc quản lý.';
            $request->session()->flash('warning', $noti);
            return redirect('teacher/course/all');
        }

        $student = Student::find($id);
        if($student == null) {
            $noti = 'Sinh viên không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect()->back();
        }

        $date = $request->date;
        $absence = $request->absence;

        $checks = Attendance::where([
            ['course_id', '=', $course_id],
            ['student_id', '=', $id],
            ['date', '=', date('Y-m-d')]
        ])->limit(1)->get();

        if(!isset($checks[0])) {
            $noti = 'Thông tin điểm danh không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect()->back();
        } else {
            $thisAtt = $checks[0];
            $thisAtt->date = $date;
            $thisAtt->absence = $absence;

            $thisAtt->save();
            $noti = 'Chỉnh sửa thành công.';
            $request->session()->flash('success', $noti);
            return redirect()->back();
        }
    }

    // add grade
    public function addGrade(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                // $allStudents = Student::all();

                // $students = [];
                // foreach($allStudents as $student)  {
                //     if($student->checkRegisteredCourse($course->id) == true) {
                //         $students[] = $student;
                //     }
                // }

                $grades = $request->grades;
                $name = $request->name;
                // dd($name);
                $index = 0;

                if($name == 'Giữa kì') {
                    $index = 30;
                } elseif($name == 'Cuối kì') {
                    $index = 60;
                }

                foreach($grades as $gradeId) {
                    $gradeInput = 'grade_' . $gradeId;
                    $gradeValue = $request->$gradeInput;

                    $grade = Grade::where([
                        ['course_id', '=', $id],
                        ['student_id', '=', $gradeId],
                        ['name', '=', $name]
                    ])->limit(1)->get();

                    if(!isset($grade[0])) {
                        $grade = new Grade();
                    } else {
                        $grade = $grade[0];
                    }

                    // dd($grade);

                    $grade->course_id = $id;
                    $grade->student_id = $gradeId;
                    $grade->grade = $gradeValue;
                    $grade->name = $name;
                    $grade->index = $index;
                    $grade->save();
                }
            }

            $noti = 'Thêm điểm thành công.';
            $request->session()->flash('success', $noti);
            return redirect()->back();
        }
    }

    public function updateGrade(Request $request, $id, $course_id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($course_id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                $student = Student::find($id);
                if($student == null) {
                    $noti = 'Sinh viên không tồn tại.';
                    $request->session()->flash('danger', $noti);
                    return redirect()->back();
                }

                $name = $request->name;
                $value = $request->value;

                $grade = Grade::where([
                    ['course_id', '=', $course_id],
                    ['student_id', '=', $id],
                    ['name', '=', $name]
                ])->limit(1)->get();

                if(!isset($grade[0])) {
                    $noti = 'Chưa tồn tại thông tin điểm ' . $name . ' cho sinh viên ' . $student->name;
                    $request->session()->flash('warning', $noti);
                    return redirect()->back();
                } else {
                    $grade = $grade[0];

                    $index = 0;
                    if($name == 'Giữa kì') {
                        $index = 30;
                    } elseif($name == 'Cuối kì') {
                        $index = 60;
                    }

                    $grade->grade = $value;
                    $grade->index = $index;
                    $grade->save();

                    $noti = 'Chỉnh sửa thành công.';
                    $request->session()->flash('success', $noti);
                    return redirect()->back();
                }
            }
        }
    }

    public function addBonus(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                $bonusStudents = $request->bonus;

                if($bonusStudents == null) {
                    $noti = 'Checkbox sinh viên cần thêm điểm bonus.';
                    $request->session()->flash('warning', $noti);
                    return redirect()->back();
                }

                $students = [];
                foreach($bonusStudents as $student)  {
                    $thisStudent = Student::find($student);
                    if($thisStudent->checkRegisteredCourse($course->id) == true) {
                        $students[] = $student;
                    }
                }

                $index = 0;

                foreach($students as $student) {
                    $bonusInput = 'bonus_' . $student;
                    $bonusValue = $request->$bonusInput;

                    $grade = new Grade();

                    $grade->course_id = $id;
                    $grade->student_id = $student;
                    $grade->grade = $bonusValue;
                    $grade->name = "Bonus";
                    $grade->index = $index;
                    $grade->save();
                }
            }

            $noti = 'Thêm điểm bonus thành công.';
            $request->session()->flash('success', $noti);
            return redirect()->back();
        }
    }

    public function updateBonus(Request $request, $id, $course_id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($course_id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
                $delete = $request->delete;
                $origin = $request->origin;
                $newGrade = $request->grade;

                $grade = Grade::where([
                    ['course_id', '=', $course_id],
                    ['student_id', '=', $id],
                    ['name', '=', "Bonus"],
                    ['grade', '=', $origin]
                ])->limit(1)->get();

                if(!isset($grade[0])) {
                    $noti = 'Điẻm bonus không tồn tại';
                    $request->session()->flash('warning', $noti);
                    return redirect()->back();
                }

                $bonus = $grade[0];

                if($delete == 1) {
                    $bonus->delete();

                    $noti = 'Xoá điểm bonus thành công.';
                    $request->session()->flash('success', $noti);
                    return redirect()->back();
                }

                $bonus->grade = $newGrade;
                $bonus->save();

                $noti = 'Update bonus thành công.';
                $request->session()->flash('success', $noti);
                return redirect()->back();
            }
        }
    }


    // end course
    public function endCourse(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Khoá học đã được kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            $teacher = $user->Employee;

            if($course->employee_id != $teacher->id) {
                $noti = 'Khoá học không thuộc quản lý.';
                $request->session()->flash('warning', $noti);
                return redirect('teacher/course/all');
            } else {
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

                        $course->status = 0;
                        $course->save();
                        $noti = 'Kết thúc khoá học thành công. Giảng viên không thể thay đổi kết quả khoá học sau khi khoá học kết thúc.';
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

    // CourseStudentsExport export grade templates
    public function exportGradesFile(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            $allStudents = $course->getAllStudents();

            $excelArray = [];
            foreach($allStudents as $student) {
                $tmp = [];
                for($i = 0; $i < 2; $i++) {
                    $type = "Cuối kì";
                    if($i % 2 == 0) {
                        $type = "Giữa kì";
                    }
                    $tmp['Mã khoá học'] = $id;
                    $tmp['id'] = $student->id;
                    $tmp['name'] = $student->name;
                    $tmp['Loại điểm'] = $type;
                    array_push($excelArray, $tmp);
                }
            }

            return Excel::download(new CourseStudentsExport($excelArray), 'khoá học ' . $course->name . '.xlsx');
        }
    }

    public function importGradesFile(Request $request, $id) {
        $user = auth()->user();
        if($user == null || ($user->role_id != _CONST::TEACHER_ROLE_ID)) {
            return redirect('/login');
        }

        $course = Course::find($id);

        if($course == null) {
            $noti = 'Khoá học không tồn tại.';
            $request->session()->flash('danger', $noti);
            return redirect('teacher/course/all');
        } else {
            if($course->status == 0) {
                $noti = 'Không thể chỉnh sửa khoá học đã kết thúc.';
                $request->session()->flash('warning', $noti);
                return redirect()->back();
            }

            if(!$request->file) {
                $request->session()->flash('danger', 'Import file không thành công.');
                return back();
            }

            try {
                Excel::import(new GradesImport, $request->file);
                $request->session()->flash('success', 'Import file thành công.');
                return back();
            } catch(\Exception $e) {
                $request->session()->flash('danger', $e->getMessage());
                return back();
            }

            // handle image upload
            // $name = '';
            // $cover_path = '';
            // $data = null;
            // if ($request->hasFile('file')) {
            //     $name = basename($request->file('file')->getClientOriginalName(), '.' . $request->file('file')->getClientOriginalExtension());
            //     $imgExtension = $request->file('file')->getClientOriginalExtension();
            //     $imgName = $name . "_" . time() . "." . $imgExtension;
            //     $request->file->move(public_path("image_upload/"), $imgName);
            //     $cover_path = "image_upload/" . $imgName;
            //     $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($cover_path);
            //     $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
            //     $spreadsheet = $reader->load($cover_path);
            //     unlink($cover_path);
            //     $data = $spreadsheet->getActiveSheet()->toArray();
            // }
            
            // if($data == null) {
            //     $noti = 'File import không thể trống.';
            //     $request->session()->flash('danger', $noti);
            //     return redirect()->back();
            // }
            // dd($data);
        }
    }
}
