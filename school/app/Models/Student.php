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

    // has many final grades
    public function FinalGrades() {
        return $this->hasMany('App\Models\FinalGrade');
    }
}
