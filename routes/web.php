<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PdfController;
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

    Route::get('/admin/manageCourses', [AdminController::class , 'manageCourses'])->name('admin.manageCourses');

    Route::get('/admin/createCourse', [AdminController::class , 'createCourse'])->name('admin.createCourse');

    Route::post('/admin/createCourse', [AdminController::class , 'saveCourse'])->name('admin.saveCourse');

    Route::get('/admin/editCourse/edit/{id}', [AdminController::class , 'editCourse'])->name('admin.editCourse');

    Route::put('/admin/manageCourse/{id}', [AdminController::class , 'updateCourse'])->name('admin.updateCourse');

    Route::delete('/admin/deleteCourse/{course}', [AdminController::class , 'deleteCourse'])->name('admin.deleteCourse');
    
    Route::get('/admin/manageAvailableDocuments', [AdminController::class , 'manageAvailableDocuments'])->name('admin.manageAvailableDocuments');

    Route::get('/admin/createDocument', [AdminController::class , 'createDocument'])->name('admin.createDocument');

    Route::post('/admin/createDocument', [AdminController::class , 'saveDocument'])->name('admin.saveDocument');

    Route::get('/admin/editDocument/edit/{id}', [AdminController::class , 'editDocument'])->name('admin.editDocument');

    Route::put('/admin/manageDocument/{id}/update', [AdminController::class , 'updateDocument'])->name('admin.updateDocument');

    Route::delete('/admin/deleteDocument/{document}', [AdminController::class , 'deleteDocument'])->name('admin.deleteDocument');

    Route::get('/admin/approvals', [AdminController::class , 'approvals'])->name('admin.approvals');

    Route::get('/admin/approvals/{user}', [AdminController::class , 'approve'])->name('admin.approve');

    Route::get('/admin/enable/{user}', [AdminController::class , 'enable'])->name('admin.enable');

    Route::get('/admin/disable/{user}', [AdminController::class , 'disable'])->name('admin.disable');

    Route::get('/admin/activeUsers', [AdminController::class , 'activeUsers'])->name('admin.activeUsers');

    Route::get('/admin/activeUsers/view/{id}', [AdminController::class , 'trackUser'])->name('admin.trackUsers');

    Route::put('/admin/activeUsers/update/{id}', [AdminController::class , 'updateUser'])->name('admin.updateUsers');

    Route::delete('/admin/activeUsers/delete/{id}', [AdminController::class , 'deleteUser'])->name('admin.deleteUsers');

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
    
    Route::post('/admin/trackRequest/reject/{document}', [AdminController::class, 'rejectRequest'])->name('admin.rejectRequest');

    Route::get('/admin/updatePassword', [AdminController::class , 'updatePassword'])->name('admin.updatePassword');

    Route::put('/admin/updatePassword/{student}', [AdminController::class , 'changePassword'])->name('admin.changePassword');

    Route::get('/admin/activeUser/update/{id}', [AdminController::class , 'getProfile'])->name('admin.getUserProfile');

    Route::put('/admin/profile/{student}', [AdminController::class , 'updateProfile'])->name('admin.updateProfile');

    Route::get('/admin/profile/edit', [AdminController::class , 'editProfile'])->name('admin.editProfile');

    Route::get('/admin/download-form/{id}', [PdfController::class, 'downloadForm'])->name('admin.download');

    Route::get('/admin/backups', [AdminController::class , 'backup'])->name('admin.backups');

    Route::post('/admin/create/backup', [AdminController::class, 'createBackup'])->name('backup.create');

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

    Route::get('/student/trackRequest/{document}/edit', [StudentController::class , 'editRequest'])->name('student.editRequest');

    Route::put('/student/trackRequest/{document}/update', [StudentController::class , 'updateRequest'])->name('student.updateRequest');

    Route::get('/student/download-form/{id}', [PdfController::class, 'downloadForm'])->name('student.download');
    

});

