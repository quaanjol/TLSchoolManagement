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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    
    
    // admin
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

});