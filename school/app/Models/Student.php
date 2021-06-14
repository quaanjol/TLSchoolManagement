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
            ['name', '=', 'Giữa kì']
        ])->limit(1)->get();
    }

    public function getLastTermGrade($id, $student_id) {
        return Grade::where([
            ['course_id', '=', $id],
            ['student_id', '=', $student_id],
            ['name', '=', 'Cuối kì']
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

    public function checkMidTermGrade($course_id) {
        $grade = Grade::where([
            ['course_id', '=', $course_id],
            ['student_id', '=', $this->id],
            ['name', '=', "Giữa kì"]
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
            ['name', '=', "Cuối kì"]
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

        // Xuất sắc: Điểm GPA từ 3.60 – 4.00
        // Giỏi: Điểm GPA từ 3.20 – 3.59
        // Khá: Điểm GPA từ 2.50 – 3.19
        // Trung bình: Điểm GPA từ 2.00 – 2.49
        // Yếu: Điểm GPA dưới 2.00

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
}
