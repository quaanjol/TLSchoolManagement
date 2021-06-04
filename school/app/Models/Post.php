<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];

    // belongs to employee, category
    public function Employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    public function PostCategory() {
        return $this->belongsTo('App\Models\PostCategory');
    }
}
