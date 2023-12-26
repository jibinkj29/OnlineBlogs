<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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


Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('user.registerBlade');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::get('forget-password', [UserController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [UserController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/Profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit/{user_id}', [UserController::class, 'profileEdit'])->name('user.profileEdit');
   
    Route::put('/profileUpdate', [UserController::class, 'profileUpdate'])->name('user.profileUpdate');
    Route::resource('blogs', BlogController::class);
    Route::resource('categories', CategoryController::class);

});

Route::controller(VerificationController::class)->group(function() {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

