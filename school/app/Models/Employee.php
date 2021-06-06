<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id', 'type', 'name', 'phone', 'email', 'gender', 'dob', 'doj', 'department_id', 'address'];
    protected $date = ['deleted_at'];

    // belongs to user, department
    public function User() {
        return $this->belongsTo('App\Models\User');
    }

    public function Department() {
        return $this->belongsTo('App\Models\Department');
    }

    // has many posts
    public function Posts() {
        return $this->hasMany('App\Models\Post');
    }
}
