<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Attendance;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id', 'name', 'phone', 'email', 'gender', 'dob', 'sYear', 'department_id', 'parent_school_id', 'address'];
    protected $date = ['deleted_at'];

    // belongs to user, parent school
    public function User() {
        return $this->belongsTo('App\Models\User');
    }

    public function Department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function ParentSchool() {
        return $this->belongsTo('App\Models\ParentSchool');
    }

    // has many final grades, grades, attendances
    public function FinalGrades() {
        return $this->hasMany('App\Models\FinalGrade');
    }

    public function Grades() {
        return $this->hasMany('App\Models\Grade');
    }

    public function Attendances() {
        return $this->hasMany('App\Models\Attendance');
    }

    // has one gpa
    public function Gpa() {
        return $this->hasOne('App\Models\Gpa');
    }

    // check if this student has registered this course
    public function checkRegisteredCourse($id) {
        $registeredCourses = $this->courses;
        if($registeredCourses == null) {
            return false;
        } else {
            if(in_array($id, unserialize($registeredCourses))) {
                return true;
            }
        }
    }

    // get course's attendancess
    public function getCourseAttendances($courseId) {
        $attendances = Attendance::where([
            ['course_id', '=', $courseId],
            ['student_id', '=', $this->id]
        ])->get();
        return $attendances;
    }

    public function getCourseAttendancesAbsence($courseId) {
        $attendances = Attendance::where([
            ['course_id', '=', $courseId],
            ['student_id', '=', $this->id],
            ['absence', '=', 1]
        ])->get();
        return $attendances;
    }

    public function getCourseAttendancesNotAbsence($courseId) {
        $attendances = Attendance::where([
            ['course_id', '=', $courseId],
            ['student_id', '=', $this->id],
            ['absence', '=', 0]
        ])->get();
        return $attendances;
    }

    public function getCourseAttendancesLate($courseId) {
        $attendances = Attendance::where([
            ['course_id', '=', $courseId],
            ['student_id', '=', $this->id],
            ['absence', '=', 2]
        ])->get();
        return $attendances;
    }

    // get grades
    public function getMidTermGrade($id, $student_id) {
        return Grade::where([
            ['course_id', '=', $id],
            ['student_id', '=', $student_id],
            ['name', '=', 'Gi???a k??']
        ])->limit(1)->get();
    }

    public function getLastTermGrade($id, $student_id) {
        return Grade::where([
            ['course_id', '=', $id],
            ['student_id', '=', $student_id],
            ['name', '=', 'Cu???i k??']
        ])->limit(1)->get();
    }

    public function getBonusGrade($id, $student_id) {
        return Grade::where([
            ['course_id', '=', $id],
            ['student_id', '=', $student_id],
            ['name', '=', 'Bonus']
        ])->get();
    }

    public function getFinalGrade($id, $student_id) {
        return FinalGrade::where([
            ['course_id', '=', $id],
            ['student_id', '=', $student_id],
        ])->limit(1)->get();
    }

    public function getFinalGradeValue($id, $student_id) {
        $finalGrade = FinalGrade::where([
            ['course_id', '=', $id],
            ['student_id', '=', $student_id],
        ])->limit(1)->get();

        if(isset($finalGrade[0])) {
            return $finalGrade[0]->resultBaseFour;
        } else {
            return 'n/a';
        }
    }

    public function checkMidTermGrade($course_id) {
        $grade = Grade::where([
            ['course_id', '=', $course_id],
            ['student_id', '=', $this->id],
            ['name', '=', "Gi???a k??"]
        ])->limit(1)->get();

        if(!isset($grade[0])) {
            return false;
        } else {
            return true;
        }
    }

    public function checkLastTermGrade($course_id) {
        $grade = Grade::where([
            ['course_id', '=', $course_id],
            ['student_id', '=', $this->id],
            ['name', '=', "Cu???i k??"]
        ])->limit(1)->get();

        if(!isset($grade[0])) {
            return false;
        } else {
            return true;
        }
    }

    public function checkBonusGrade($course_id) {
        $grade = Grade::where([
            ['course_id', '=', $course_id],
            ['student_id', '=', $this->id],
            ['name', '=', "Bonus"]
        ])->get();

        if($grade->count() <= 0) {
            return false;
        } else {
            return true;
        }
    }

    // calculate gpa
    public function reCalculateGpa() {
        $finalGrades = FinalGrade::where([
            ['student_id', '=', $this->id]
        ])->get();

        $gpa = Gpa::find($this->id);

        if($gpa == null) {
            $gpa = new Gpa();
            $gpa->student_id = $this->id;
        }

        // Xu???t s???c: ??i???m GPA t??? 3.60 ??? 4.00
        // Gi???i: ??i???m GPA t??? 3.20 ??? 3.59
        // Kh??: ??i???m GPA t??? 2.50 ??? 3.19
        // Trung b??nh: ??i???m GPA t??? 2.00 ??? 2.49
        // Y???u: ??i???m GPA d?????i 2.00

        if($finalGrades->count() <= 0) {
            $result = 0;
            $resultBaseFour = $result / 2.5;
            $gpa->result = $result;
            $gpa->resultBaseFour = $resultBaseFour;
            if($resultBaseFour >= 3.6 && $resultBaseFour <= 4) {
                $rank = "S";
            } elseif($resultBaseFour >= 3.2 && $resultBaseFour <= 3.59) {
                $rank = "A";
            } elseif($resultBaseFour >= 2.5 && $resultBaseFour <= 3.19) {
                $rank = "B";
            } elseif($resultBaseFour >= 2 && $resultBaseFour <= 2.49) {
                $rank = "C";
            }elseif($resultBaseFour < 2) {
                $rank = "D";
            }
            $gpa->rank = $rank;
        } else {
            $result = 0;
            $totalIndex = 0;
            $rank = 1;
            foreach($finalGrades as $finalGrade) {
                $credit = Course::find($finalGrade->course_id)->Subject->credit;
                $totalIndex += $credit;
                $result += $finalGrade->result * $credit;
            }

            $result = $result / $totalIndex;
            $resultBaseFour = $result / 2.5;
            $gpa->result = $result;
            $gpa->resultBaseFour = $resultBaseFour;
            if($resultBaseFour >= 3.6 && $resultBaseFour <= 4) {
                $rank = 1;
            } elseif($resultBaseFour >= 3.2 && $resultBaseFour <= 3.59) {
                $rank = 2;
            } elseif($resultBaseFour >= 2.5 && $resultBaseFour <= 3.19) {
                $rank = 3;
            } elseif($resultBaseFour >= 2 && $resultBaseFour <= 2.49) {
                $rank = 4;
            }elseif($resultBaseFour < 2) {
                $rank = 5;
            }
            $gpa->rank = $rank;
        }

        $gpa->save();
        return $gpa;
    }

    public function reCalculateCourseFinalGrade($id) {
        $finalGrade = $student->getFinalGrade($id, $this->id);

        if(!isset($finalGrade[0])) {
            $finalGrade = new FinalGrade();
        } else {
            $finalGrade = $finalGrade[0];
        }

        $finalGrade->course_id = $id;
        $finalGrade->student_id = $this->id;

        $attendanceGrade = ($student->getCourseAttendancesNotAbsence($id)->count() * 1 + $student->getCourseAttendancesLate($id)->count() * 0.5) / $student->getCourseAttendances($id)->count();
        $attendanceCount = 1;
        $bonuses = $student->getBonusGrade($id, $this->id);
        foreach($bonuses as $bonus) {
            $attendanceGrade += $bonus->grade;
            $attendanceCount++;
        }

        $attendanceGrade = $attendanceGrade / $attendanceCount;
        $midTermGrade = $student->getMidTermGrade($id, $this->id);
        $lastTermGrade = $student->getLastTermGrade($id, $this->id);

        if(!isset($midTermGrade[0])) {
            $noti = 'Kh??ng th??? k???t th??c kho?? h???c v?? sinh vi??n ' . $this->name . ' ch??a c?? ??i???m gi???a k??.';
            $request->session()->flash('warning', $noti);
            return redirect()->back();
        } else {
            $midTermGrade = $midTermGrade[0];
        }

        if(!isset($lastTermGrade[0])) {
            $noti = 'Kh??ng th??? k???t th??c kho?? h???c v?? sinh vi??n ' . $this->name . ' ch??a c?? ??i???m cu???i k??.';
            $request->session()->flash('warning', $noti);
            return redirect()->back();
        } else {
            $lastTermGrade = $lastTermGrade[0];
        }

        $result  = ($attendanceGrade * 10 + $midTermGrade->grade * 30 + $lastTermGrade->grade * 60) / 100;
        $resultBaseFour = $result / 2.5;

        //8.5 ??? 10	A
        //7.0 ??? 8.4	B
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
    }
}
