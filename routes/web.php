<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\StaticAdminController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\TuitionController;
use App\Http\Controllers\TypePayController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckLoginStudent;

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

//User page
Route::get('/login', [StudentController::class, 'login'])->name("login");
Route::post('/login', [StudentController::class, 'loginProcess'])->name("login-process");
    //Middleware
    Route::middleware([CheckLoginStudent::class])->group(function(){
        Route::get('/history', [StudentController::class, 'history'])->name('history');
        Route::get('/', [StudentController::class, 'dashboard'])->name('home');
        Route::get('/quy-dinh-hoc-phi', function(){
            return view('student.quydinh');
        })->name('quydinhhocphi');
        Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
        Route::post('/profile/change', [StudentController::class, 'changePassword'])->name('change.passwordUser');

    });
//End user
//Admin page
// Route::group(['prefix'=>'admin'], function(){
Route::prefix('admin')->group(function(){
    //Quen mat khau
    Route::get('/quen-mat-khau',[ResetPasswordController::class, 'quen_mat_khau'])->name('quen_mat_khau');
    Route::get('/update-new-pass',[ResetPasswordController::class, 'update_new_pass'])->name('update_new_pass');
    Route::post('/recover-pass',[ResetPasswordController::class, 'recover_pass'])->name('recover_pass');
    Route::post('/reset-new-pass',[ResetPasswordController::class, 'reset_new_pass'])->name('reset_new_pass');

    Route::get('/login', [AdminController::class, 'login'])->name("admin.login");
    Route::post('/login-process', [AdminController::class, 'loginProcess'])->name("admin.login-process");
    //Middleware
    Route::middleware([CheckLogin::class])->group(function(){
        //Admin dashboard
        Route::get('/', [StaticAdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/edit', [AdminController::class, 'edit'])->name('admin.edit'); 
        Route::post('/update', [AdminController::class ,'update'])->name('admin.update');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        //Grade
        Route::resource('grade', GradeController::class);
        Route::get('/grade/filter/{id}',[GradeController::class, 'filter'])->name('grade.filter');
        //Resource 
        Route::resource('scholarship', ScholarshipController::class);
        Route::resource('typepay', TypePayController::class);
        Route::resource('course', CourseController::class);
        Route::resource('major', MajorController::class);
        // Student 
        //Send mail to student
        Route::post('/message/send', [FrontController::class, 'addFeedback'])->name('front.fb');
        //Import student
        Route::post('/student/import', [StudentController::class,'import'])->name('student.import');
        //Export student 
        Route::get('/student/export', [StudentController::class,'export'])->name('student.export');
        //Live search
        Route::get('/student/search', [StudentController::class,'search'])->name('student.search');
        //Resource
        Route::resource('student', StudentController::class);
        //Status
        Route::get('/student/detail/{id}',[StaticController::class,'statusStudent'])->name('student.detail');
        //Static
        Route::get('/student/static',[StaticController::class,'staticStudent'])->name('student.static');
    
        //End student
        //Tuition
        Route::post('tuition/edit', [TuitionController::class,'edit'])->name('tuition.edit');
        Route::get('tuition/create', [TuitionController::class,'create'])->name('tuition.create');
        Route::get('tuition/index', [TuitionController::class,'index'])->name('tuition.index');
        Route::post('tuition/store', [TuitionController::class,'store'])->name('tuition.store');
        Route::post('tuition/update', [TuitionController::class,'update'])->name('tuition.update');
        //End tuition
        //Bill
        Route::get('create-bill', [BillController::class,'create'])->name('bill.create');
        Route::post('add-bill', [BillController::class,'add'])->name('bill.add');
        Route::get('all-bill', [BillController::class,'index'])->name('bill.index');
        Route::get('store-bill', [BillController::class,'store'])->name('bill.store');
        Route::get('detail-bill/{id}', [BillController::class,'detail'])->name('bill.detail');
        Route::get('filter-bill/{id}', [BillController::class,'filter'])->name('bill.filter');
        Route::get('/bill/search', [BillController::class,'search'])->name('bill.search');
    });


});
//End admin
