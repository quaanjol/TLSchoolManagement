<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpa extends Model
{
    use HasFactory;

    // belongs to student
    public function Student() {
        return $this->belongsTo('App\Models\Student');
    }
}
