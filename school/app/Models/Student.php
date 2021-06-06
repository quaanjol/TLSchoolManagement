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

    // get mid term grade
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
}
