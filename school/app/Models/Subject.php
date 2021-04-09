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
        return $this->hasOne('App\Models\Course');
    }
}
