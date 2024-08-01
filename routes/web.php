<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// authenticationnn
Route::get('/', [AuthController::class , 'login'])->name('login');

Route::post('/', [AuthController::class , 'authenticate']);

Route::get('/signup', [AuthController::class , 'register'])->name('signup');
// registering account
Route::post('/users', [AuthController::class,'store'])->name('users.store');

Route::get('/confirmation', [AuthController::class , 'confirmation'])->name('confirmation');

Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

Route::get('password/reset', [PasswordResetController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Handle sending the password reset link
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Show the form to reset the password
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

// Handle the password reset form submission
Route::post('password/reset/', [PasswordResetController::class, 'reset'])
    ->name('password.update');



// admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class , 'index'])->name('admin.dashboard');

    Route::get('/admin/profile', [AdminController::class , 'profile'])->name('admin.profile');

    Route::get('/admin/manageDigitalForms', [AdminController::class , 'manageDigitalForms'])->name('admin.manageDigitalForms');

    Route::get('/admin/approvals', [AdminController::class , 'approvals'])->name('admin.approvals');

    Route::get('/admin/approvals/{user}', [AdminController::class , 'approve'])->name('admin.approve');

    Route::get('/admin/enable/{user}', [AdminController::class , 'enable'])->name('admin.enable');

    Route::get('/admin/disable/{user}', [AdminController::class , 'disable'])->name('admin.disable');

    Route::get('/admin/activeUsers', [AdminController::class , 'activeUsers'])->name('admin.activeUsers');

    Route::get('/admin/requestLogs', [AdminController::class , 'requestLogs'])->name('admin.requestLogs');

    
    Route::get('/admin/all-request', [AdminController::class, 'allRequest'])->name('admin.allRequest');

    Route::get('/admin/last-two-weeks', [AdminController::class, 'lastTwoWeeks'])->name('admin.lastTwoWeeks');

    Route::get('/admin/last-month', [AdminController::class, 'lastMonth'])->name('admin.lastMonth');

    Route::get('/admin/completed', [AdminController::class, 'completed'])->name('admin.completed');

    Route::get('/admin/rejected', [AdminController::class, 'rejected'])->name('admin.rejected');

    Route::get('/admin/for-deletion', [adminController::class, 'forDeletion'])->name('admin.forDeletion');
    
    Route::get('/admin/listOfRequestForms', [AdminController::class , 'listOfRequestForms'])->name('admin.listOfRequestForms');

    Route::get('/admin/trackRequest/{document}', [AdminController::class , 'trackRequest'])->name('admin.trackRequest');
    
    Route::delete('/admin/trackRequest/{document}', [AdminController::class , 'deleteRequest'])->name('admin.deleteRequest');

    Route::get('/admin/trackRequest/approve/{document}', [AdminController::class , 'approveRequest'])->name('admin.approveRequest');
    
    Route::get('/admin/trackRequest/reject/{document}', [AdminController::class, 'rejectRequest'])->name('admin.rejectRequest');

    Route::get('/admin/updatePassword', [AdminController::class , 'updatePassword'])->name('admin.updatePassword');

    Route::put('/admin/updatePassword/{student}', [AdminController::class , 'changePassword'])->name('admin.changePassword');

    Route::put('/admin/profile/{student}', [AdminController::class , 'updateProfile'])->name('admin.updateProfile');

    Route::get('/admin/profile/edit', [AdminController::class , 'editProfile'])->name('admin.editProfile');
});


Route::middleware(['auth', 'student'])->group(function () {

    Route::get('/student', [StudentController::class , 'index'])->name('student.dashboard');

    Route::get('/student/profile', [StudentController::class , 'profile'])->name('student.profile');

    Route::get('/student/updatePassword', [StudentController::class , 'updatePassword'])->name('student.updatePassword');

    Route::put('/student/updatePassword/{student}', [StudentController::class , 'changePassword'])->name('student.changePassword');

    Route::put('/student/profile/{student}', [StudentController::class , 'updateProfile'])->name('student.updateProfile');

    Route::get('/student/profile/edit', [StudentController::class , 'editProfile'])->name('student.editProfile');

    Route::get('/student/listOfRequestForms', [StudentController::class , 'listOfRequestForms'])->name('student.listOfRequestForms');

    Route::get('/student/updatePassword', [StudentController::class , 'updatePassword'])->name('student.updatePassword');

    Route::get('/student/createNewRequest', [StudentController::class , 'createNewRequest'])->name('student.createNewRequest');

    Route::get('/student/historyOfRequest', [StudentController::class , 'historyOfRequest'])->name('student.historyOfRequest');

    Route::get('/student/all-request', [StudentController::class, 'allRequest'])->name('student.allRequest');

    Route::get('/student/last-two-weeks', [StudentController::class, 'lastTwoWeeks'])->name('student.lastTwoWeeks');

    Route::get('/student/last-month', [StudentController::class, 'lastMonth'])->name('student.lastMonth');

    Route::get('/student/completed', [StudentController::class, 'completed'])->name('student.completed');

    Route::get('/student/rejected', [StudentController::class, 'rejected'])->name('student.rejected');

    Route::get('/student/for-deletion', [StudentController::class, 'forDeletion'])->name('student.forDeletion');

    Route::post('/student/createNewRequest', [StudentController::class , 'request'])->name('student.request');

    Route::get('/student/trackRequest/{document}', [StudentController::class , 'trackRequest'])->name('student.trackRequest');

    Route::put('/student/trackRequest/{document}', [StudentController::class , 'deleteRequest'])->name('student.deleteRequest');



});

