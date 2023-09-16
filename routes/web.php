<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;


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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout',[AdminController::class,'Logout'])->name('admin.logout');

// User Management All Routes

Route::prefix('users')->group(function(){
  
    Route::get('/view',[UserController::class,'UserView'])->name('user.view');

    Route::get('/add',[UserController::class,'UserAdd'])->name('users.add');

    Route::post('/store',[UserController::class,'UserStore'])->name('users.store');

    Route::get('/edit/{id}',[UserController::class,'UserEdit'])->name('users.edit');

    Route::post('/update/{id}',[UserController::class,'UserUpdate'])->name('users.update');

    Route::get('/delete/{id}',[UserController::class,'UserDelete'])->name('users.delete');
});


// Profile and Change Password  All Routes

Route::prefix('profiles')->group(function(){
  
    Route::get('/view',[ProfileController::class,'ProfileView'])->name('profile.view');

    Route::get('/edit',[ProfileController::class,'ProfileEdit'])->name('profile.edit');

    Route::post('/store',[ProfileController::class,'ProfileStore'])->name('profile.store');

    Route::get('/password/view',[ProfileController::class,'PasswordView'])->name('password.view');

    Route::post('/password/update',[ProfileController::class,'PasswordUpdate'])->name('profile.password.update');


});