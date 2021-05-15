<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];

    // has many courses
    public function Courses() {
        return $this->hasMany('App\Models\Course');
    }

    // check if student can register
    public function checkStudent($departmentId) {
        $valiDepartments = unserialize($this->departments);
        if(in_array($departmentId, $valiDepartments)) {
            return true;
        } else {
            return false;
        }
    }
}
