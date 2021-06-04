<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Student;
use App\Models\ParentSchool;
use App\Models\Subject;
use App\Models\Course;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Attendance;
use App\Models\FinalGrade;
use App\Models\Grade;
use App\Http\Controllers\_CONST;
use View;

class BaseController extends Controller {

    public function __construct() {
        $postCategories = PostCategory::orderBy('id', 'ASC')->get();
        View::share ( 'postCategories', $postCategories );
    }  

}

class UserController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    // show
    public function show() {
        $departments = Department::orderBy('id', 'DESC')->get();
        $newss = Post::orderBy('id', 'desc')->limit(3)->get();
        $events = Post::orderBy('id', 'desc')->where('post_category_id', '=', 6)->limit(2)->get();
        return view('user.web.index')->with([
            'departments' => $departments,
            'newss' => $newss,
            'events' => $events
        ]);
    }
}
