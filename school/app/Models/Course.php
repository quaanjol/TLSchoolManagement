<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];

    // belongs to subject, teacher
    public function Subject() {
        return $this->belongsTo('App\Models\Subject');
    }

    public function Employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    // has many attendances
    public function Attendances() {
        return $this->hasMany('App\Models\Attendance');
    }

    public function Grades() {
        return $this->hasMany('App\Models\Grade');
    }
}
