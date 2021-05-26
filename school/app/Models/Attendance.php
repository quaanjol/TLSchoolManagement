<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];

    // belongs to course, student
    public function Course() {
        return $this->belongsTo('App\Models\Course');
    }

    public function Student() {
        return $this->belongsTo('App\Models\Student');
    }
}
