<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\User\UserController@show')->name('index');
Route::get('/home', 'App\Http\Controllers\User\UserController@show')->name('home');

Auth::routes(['register' => false]);

Route::get('/redirect', [App\Http\Controllers\HomeController::class, 'index'])->name('redirect');

// backend side
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admins', 'App\Http\Controllers\AdminController');
    Route::resource('courses', 'App\Http\Controllers\CourseController');
    Route::resource('departments', 'App\Http\Controllers\DepartmentController');
    Route::resource('employees', 'App\Http\Controllers\EmployeeController');
    Route::resource('parents', 'App\Http\Controllers\ParentSchoolController');
    Route::resource('postCategories', 'App\Http\Controllers\PostCategoryController');
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::resource('students', 'App\Http\Controllers\StudentController');
    Route::resource('subjects', 'App\Http\Controllers\SubjectController');
    
    
    // <= admin =>
    Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@show')->name('admin.dashboard');
    Route::get('/theme/{color}', 'App\Http\Controllers\AdminController@changeTheme')->name('theme.change');
    Route::get('/admin/profile', 'App\Http\Controllers\AdminController@profile')->name('admin.profile');
    Route::post('/admin/profile', 'App\Http\Controllers\AdminController@profileStore')->name('admin.profile.store');
    
    // roles
    Route::get('admin/role/all', 'App\Http\Controllers\RoleController@show')->name('admin.role.all');

    // employee
    Route::get('admin/administrator/all', 'App\Http\Controllers\EmployeeController@allAdministrators')->name('admin.administrator.all');
    Route::get('admin/administrator/create', 'App\Http\Controllers\EmployeeController@createEmployee')->name('admin.administrator.create');
    Route::post('admin/administrator/create', 'App\Http\Controllers\EmployeeController@storeEmployee')->name('admin.administrator.store');
    Route::get('admin/administrator/update/{id}', 'App\Http\Controllers\EmployeeController@updateEmployee')->name('admin.administrator.update');
    Route::post('admin/administrator/update/{id}', 'App\Http\Controllers\EmployeeController@storeUpdateEmployee')->name('admin.administrator.storeUpdate');


    Route::get('admin/teacher/all', 'App\Http\Controllers\EmployeeController@allTeachers')->name('admin.teacher.all');
    Route::get('admin/teacher/create', 'App\Http\Controllers\EmployeeController@createTeacher')->name('admin.teacher.create');
    Route::post('admin/teacher/create', 'App\Http\Controllers\EmployeeController@storeTeacher')->name('admin.teacher.store');
    Route::get('admin/teacher/update/{id}', 'App\Http\Controllers\EmployeeController@updateTeacher')->name('admin.teacher.update');
    Route::post('admin/teacher/update/{id}', 'App\Http\Controllers\EmployeeController@storeUpdateTeacher')->name('admin.teacher.storeUpdate');
    Route::get('admin/teacher/import', 'App\Http\Controllers\EmployeeController@importTeacher')->name('admin.teacher.import');
    Route::post('admin/teacher/import', 'App\Http\Controllers\EmployeeController@storeImportTeacher')->name('admin.teacher.storeImport');
    Route::get('/admin/teacher/download-file-teacher-import-form', function() {
        $path = storage_path('import/TeacherTestImport.xlsx');
        return response()->download($path);
    })->name('admin.teacher.download.import_file');

    // parents
    Route::get('admin/parent/all', 'App\Http\Controllers\ParentSchoolController@allParentSchools')->name('admin.parent.all');
    Route::get('admin/parent/create', 'App\Http\Controllers\ParentSchoolController@createParentSchool')->name('admin.parent.create');
    Route::post('admin/parent/create', 'App\Http\Controllers\ParentSchoolController@storeParentSchool')->name('admin.parent.store');
    Route::get('admin/parent/update/{id}', 'App\Http\Controllers\ParentSchoolController@updateParentSchool')->name('admin.parent.update');
    Route::post('admin/parent/update/{id}', 'App\Http\Controllers\ParentSchoolController@storeUpdateParentSchool')->name('admin.parent.storeUpdate');

    // students
    Route::get('admin/student/all', 'App\Http\Controllers\StudentController@allStudents')->name('admin.student.all');
    Route::get('admin/student/create', 'App\Http\Controllers\StudentController@createStudent')->name('admin.student.create');
    Route::post('admin/student/create', 'App\Http\Controllers\StudentController@storeStudent')->name('admin.student.store');
    Route::get('admin/student/update/{id}', 'App\Http\Controllers\StudentController@updateStudent')->name('admin.student.update');
    Route::post('admin/student/update/{id}', 'App\Http\Controllers\StudentController@storeUpdateStudent')->name('admin.student.storeUpdate');
    Route::get('admin/student/import', 'App\Http\Controllers\StudentController@import')->name('admin.student.import');
    Route::post('admin/student/import', 'App\Http\Controllers\StudentController@storeImport')->name('admin.student.storeImport');
    Route::get('/admin/student/download-file-student-import-form', function() {
        $path = storage_path('import/StudentTestImport.xlsx');
        return response()->download($path);
    })->name('admin.student.download.import_file');

    // departments
    Route::get('admin/department/all', 'App\Http\Controllers\DepartmentController@allDepartments')->name('admin.department.all');
    Route::get('admin/department/create', 'App\Http\Controllers\DepartmentController@createDepartment')->name('admin.department.create');
    Route::post('admin/department/create', 'App\Http\Controllers\DepartmentController@storeDepartment')->name('admin.department.store');
    Route::get('admin/department/update/{id}', 'App\Http\Controllers\DepartmentController@updateDepartment')->name('admin.department.update');
    Route::post('admin/department/update/{id}', 'App\Http\Controllers\DepartmentController@storeUpdateDepartment')->name('admin.department.storeUpdate');

    // subjects
    Route::get('admin/subject/all', 'App\Http\Controllers\SubjectController@all')->name('admin.subject.all');
    Route::get('admin/subject/create', 'App\Http\Controllers\SubjectController@create')->name('admin.subject.create');
    Route::post('admin/subject/create', 'App\Http\Controllers\SubjectController@store')->name('admin.subject.store');
    Route::get('admin/subject/update/{id}', 'App\Http\Controllers\SubjectController@update')->name('admin.subject.update');
    Route::post('admin/subject/update/{id}', 'App\Http\Controllers\SubjectController@storeUpdate')->name('admin.subject.storeUpdate');

    // courses
    Route::get('admin/course/all', 'App\Http\Controllers\CourseController@all')->name('admin.course.all');
    Route::get('admin/course/create', 'App\Http\Controllers\CourseController@create')->name('admin.course.create');
    Route::post('admin/course/create', 'App\Http\Controllers\CourseController@store')->name('admin.course.store');
    Route::get('admin/course/update/{id}', 'App\Http\Controllers\CourseController@update')->name('admin.course.update');
    Route::post('admin/course/update/{id}', 'App\Http\Controllers\CourseController@storeUpdate')->name('admin.course.storeUpdate');
    Route::get('admin/course/view/{id}', 'App\Http\Controllers\CourseController@view')->name('admin.course.view');

    // post categiries
    Route::get('admin/post-category/all', 'App\Http\Controllers\PostCategoryController@all')->name('admin.category.all');
    Route::get('admin/post-category/create', 'App\Http\Controllers\PostCategoryController@create')->name('admin.category.create');
    Route::post('admin/post-category/create', 'App\Http\Controllers\PostCategoryController@store')->name('admin.category.store');
    Route::get('admin/post-category/update/{id}', 'App\Http\Controllers\PostCategoryController@update')->name('admin.category.update');
    Route::post('admin/post-category/update/{id}', 'App\Http\Controllers\PostCategoryController@storeUpdate')->name('admin.category.storeUpdate');

    // posts
    Route::get('admin/post/all', 'App\Http\Controllers\PostController@all')->name('admin.post.all');
    Route::get('admin/post/create', 'App\Http\Controllers\PostController@create')->name('admin.post.create');
    Route::post('admin/post/create', 'App\Http\Controllers\PostController@store')->name('admin.post.store');
    Route::get('admin/post/update/{id}', 'App\Http\Controllers\PostController@update')->name('admin.post.update');
    Route::post('admin/post/update/{id}', 'App\Http\Controllers\PostController@storeUpdate')->name('admin.post.storeUpdate');
    
    // ckeditor
    Route::post('ckeditor/upload', 'App\Http\Controllers\CKEditorController@upload')->name('ckeditor.upload');

    // <= student =>
    Route::get('/student/dashboard', 'App\Http\Controllers\Student\StudentController@show')->name('student.dashboard');
    Route::get('/theme/{color}', 'App\Http\Controllers\AdminController@changeTheme')->name('theme.change');
    Route::get('/student/profile', 'App\Http\Controllers\Student\StudentController@profile')->name('student.profile');
    Route::post('/student/profile', 'App\Http\Controllers\Student\StudentController@profileStore')->name('student.profile.store');

    // teacher
    Route::get('/student/teacher/all', 'App\Http\Controllers\Student\TeacherController@show')->name('student.teacher.all');

    // department
    Route::get('/student/department/all', 'App\Http\Controllers\Student\DepartmentController@show')->name('student.department.all');

    // subject
    Route::get('/student/subject/all', 'App\Http\Controllers\Student\SubjectController@show')->name('student.subject.all');

    // course
    Route::get('/student/course/all', 'App\Http\Controllers\Student\CourseController@show')->name('student.course.all');
    Route::get('/student/course/registered/all', 'App\Http\Controllers\Student\CourseController@registeredCourses')->name('student.course.registered.all');
    Route::get('/student/course/register/{id}', 'App\Http\Controllers\Student\CourseController@register')->name('student.course.register');





    // <= teacher =>
    Route::get('/teacher/dashboard', 'App\Http\Controllers\Teacher\TeacherController@show')->name('teacher.dashboard');
    Route::get('/theme/{color}', 'App\Http\Controllers\AdminController@changeTheme')->name('theme.change');
    Route::get('/teacher/profile', 'App\Http\Controllers\Teacher\TeacherController@profile')->name('teacher.profile');
    Route::post('/teacher/profile', 'App\Http\Controllers\Teacher\TeacherController@profileStore')->name('teacher.profile.store');


    // subject
    Route::get('/teacher/subject/all', 'App\Http\Controllers\Teacher\SubjectController@show')->name('teacher.subject.all');

    // course
    Route::get('/teacher/course/all', 'App\Http\Controllers\Teacher\CourseController@show')->name('teacher.course.all');
    Route::get('/teacher/course/manage/{id}/{slug}', 'App\Http\Controllers\Teacher\CourseController@manage')->name('teacher.course.manage');
    Route::post('/teacher/course/checkAttendance/{id}', 'App\Http\Controllers\Teacher\CourseController@checkAttendance')->name('teacher.course.checkAttendance');
    Route::post('/teacher/course/addGrade/{id}', 'App\Http\Controllers\Teacher\CourseController@addGrade')->name('teacher.course.addGrade');
    Route::post('/teacher/course/attendance/update/{id}/{course_id}', 'App\Http\Controllers\Teacher\CourseController@updateAttendance')->name('teacher.course.updateAttendance');
    Route::post('/teacher/course/grade/update/{id}/{course_id}', 'App\Http\Controllers\Teacher\CourseController@updateGrade')->name('teacher.course.updateGrade');
    Route::post('/teacher/course/addBonus/{id}', 'App\Http\Controllers\Teacher\CourseController@addBonus')->name('teacher.course.addBonus');
    Route::post('/teacher/course/bonus/update/{id}/{course_id}', 'App\Http\Controllers\Teacher\CourseController@updateBonus')->name('teacher.course.updateBonus');
    Route::get('/teacher/course/endCourse/{id}', 'App\Http\Controllers\Teacher\CourseController@endCourse')->name('teacher.course.endCourse');
    Route::get('/teacher/course/exportGradesFile/{id}', 'App\Http\Controllers\Teacher\CourseController@exportGradesFile')->name('teacher.course.exportGradesFile');
    Route::post('/teacher/course/importGradesFile/{id}', 'App\Http\Controllers\Teacher\CourseController@importGradesFile')->name('teacher.course.importGradesFile');
});