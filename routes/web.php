<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AsignSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentEntrollControl;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/authLogin',[AuthController::class,'authLogin'])->name('AuthLogin');
Route::get('/auth/forgetPassword',[AuthController::class, 'forgetPassword'])->name('auth.fogetpassword');
Route::post('/auth/forget',[AuthController::class, 'forget'])->name('auth.forget');
Route::get('reset/{remember_token}',[AuthController::class, 'reset'])->name('auth.reset');
Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('auth.resetPassword');
Route::get('logout',[AuthController::class, 'logout'])->name('logout');



// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

// Route::get('/admin/admin/list', function () {
//     return view('admin.admin.list');
// });

Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/admin/list',[AdminController::class, 'list'])->name('admin.list');
    Route::get('/admin/admin/newuser',[AdminController::class, 'addNewUser'])->name('admin.user');
    Route::post('/admin/admin/user',[AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/admin/edit/{id}',[AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/admin/update',[AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');


    /*Class Routes*/
    Route::get('/class',[ClassController::class,'index'])->name('admin.class');
    Route::get('/class/create',[ClassController::class, 'addClass'])->name('admin.addClass');
    Route::post('/class/insert',[ClassController::class, 'insertClass'])->name('admin.insertClass');
    Route::get('/class/edit/{id}',[ClassController::class, 'edit'])->name('admin.edit');
    Route::post('/class/update',[ClassController::class, 'update'])->name('admin.class.update');
    Route::get('/class/delete/{id}',[ClassController::class, 'destroy'])->name('admin.class.delete');


    //Subject Route
    Route::get('/subject',[SubjectController::class,'index'])->name('admin.subject');
    Route::get('/subject/create',[SubjectController::class, 'addSubject'])->name('admin.subject.addsubject');
    Route::post('/subject/insert',[SubjectController::class, 'insertSubject'])->name('admin.subject.insertSubject');
    Route::get('/subject/edit/{id}',[SubjectController::class, 'edit'])->name('admin.subject.edit');
    Route::post('/subject/update',[SubjectController::class,'update'])->name('admin.update.subject');
    Route::get('/subject/delete/{id}',[SubjectController::class, 'destroy'])->name('admin.subjec.delete');


    //Asign Subject Routes
    Route::get('/asignsubject',[AsignSubjectController::class,'index'])->name('admin.asignSubject');
    Route::get('/asignsubject/create',[AsignSubjectController::class, 'addAsignSubject'])->name('admin.asignsbuject.addAsignSubject');
    Route::post('/asign/insert',[AsignSubjectController::class, 'insert'])->name('admin.asignsubject.insert');
    Route::get('/asignsubject/edit/{id}',[AsignSubjectController::class, 'edit'])->name('admin.asign.edit');
    Route::post('/asignsubject/update',[AsignSubjectController::class, 'update'])->name('admin.asignsubject.update');
    Route::get('/asign/delete/{id}',[AsignSubjectController::class, 'destroy'])->name('admin.asignsubject.delete');

    /*Change Password*/
    Route::get('/change_password',[UserController::class,'index'])->name('admin.change_password.index');
    Route::post('/change_password/update',[UserController::class, 'change_password'])->name('admin.change_password.changePassword');

    //Enroll Student//
    Route::get('/student',[StudentEntrollControl::class,'index'])->name('admin.student');
    Route::get('/student/create',[StudentEntrollControl::class, 'addStudent'])->name('admin.student.addStudent');

});

Route::group(['middleware' => 'teacher'], function(){
    Route::get('/teacher/dashboard',[DashboardController::class,'dashboard'])->name('teacher.dashboard');
    Route::get('/change_password',[UserController::class,'index'])->name('admin.change_password.index');
    Route::post('/change_password/update',[UserController::class, 'change_password'])->name('admin.change_password.changePassword');
});

Route::group(['middleware' => 'student'], function(){
    Route::get('/student/dashboard',[DashboardController::class,'dashboard'])->name('student.dashboard');
    Route::get('/change_password',[UserController::class,'index'])->name('admin.change_password.index');
    Route::post('/change_password/update',[UserController::class, 'change_password'])->name('admin.change_password.changePassword');
});

Route::group(['middleware' => 'parents'], function(){
    Route::get('/parents/dashboard',[DashboardController::class,'dashboard'])->name('parents.dashboard');
    Route::get('/change_password',[UserController::class,'index'])->name('admin.change_password.index');
    Route::post('/change_password/update',[UserController::class, 'change_password'])->name('admin.change_password.changePassword');
});
