<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Mail\UserWelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('cms/')->middleware('guest:admin,user')->group(function () {

    Route::get('/{guard}/login', [AuthController::class, 'show'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('forget-password', [ResetPasswordController::class, 'showForgetPassword'])
        ->name('password.forget');
    Route::post('forget-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
});
Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::prefix('cms/admin')->middleware(['auth:admin,user', 'verified'])->group(function () {
    Route::view('/', 'cms.temp');
    Route::resource('cities', CityController::class);
    Route::resource('users', UserController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
});
Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {

    Route::get('roles/{role}/permissions/edit', [RoleController::class, 'editRolePermissions'])->name('roles.edit.permissions');
    Route::put('roles/{role}/permissions/edit', [RoleController::class, 'updateRolePermissions']);
    Route::get('users/{user}/permissions/edit', [UserController::class, 'editUserPermissions'])->name('user.edit.permissions');
    Route::put('users/{user}/permissions/edit', [UserController::class, 'updateUserPermissions']);
});

Route::prefix('cms/admin')->middleware(['auth:admin'])->group(function () {

    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice'); // this must be middleware:auth becace request->user get just auth user
});

Route::middleware('ageCheck:20')->group(function () {

    // the argument 20 is a varibale in class agecheck its the same when you use auth:user , auth:admin // auth:guPPard

    Route::get('news1', function () {
        echo 'Hello world 1';
        // dd(123);
    });
});
// withoutMiddleware is not working with me ?!
Route::get('news2', function () {
    echo 'Hello world 2';
})->middleware('ageCheck:18');

Route::get('test-email', function () {
    // return view('emails.user_welcome_email');
    return new UserWelcomeEmail(User::first());
});
