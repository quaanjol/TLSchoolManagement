<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['course_id', 'student_id', 'name', 'grade', 'index'];
    protected $date = ['deleted_at'];

    // belongs to course, student
    public function Course() {
        return $this->belongsTo('App\Models\Course');
    }

    public function Student() {
        return $this->belongsTo('App\Models\Student');
    }
}
