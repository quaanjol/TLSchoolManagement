<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
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

    // has many final grades, grades
    public function FinalGrades() {
        return $this->hasMany('App\Models\FinalGrade');
    }

    public function Grades() {
        return $this->hasMany('App\Models\Grade');
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
}
