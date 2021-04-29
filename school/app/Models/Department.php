<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];

    // has many employees, students
    public function Employees() {
        return $this->hasMany('App\Models\Employee');
    }

    public function Students() {
        return $this->hasMany('App\Models\Student');
    }
}
