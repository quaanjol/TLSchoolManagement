<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentSchool extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];

    // belongs to user
    public function User() {
        return $this->belongsTo('App\Models\User');
    }

    // has many students
    public function Students() {
        return $this->hasMany('App\Models\Student');
    }
}
