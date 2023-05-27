<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Vendor;
use App\Http\Controllers\User;
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

//All Users
Route::middleware('auth')->group(function(){
    //Admin Routes
Route::controller(Admin::class)->group(function(){
    //render admin dashboard
    Route::get('/admin-dashboard','dashboard')->name('admin.dashboard')->middleware('role:admin');
    //admin logout
    Route::get('/admin-logout','destroy')->name('admin.logout')->middleware('role:admin');
    //admin profile
    Route::get('/admin-profile','adminProfile')->name('admin.profile')->middleware('role:admin');
    //Admin Profile Update
    Route::post('/admin-profile-update','adminUpdate')->name('admin.profile.update')->middleware('role:admin');
    //Admin Password Change
    Route::get('/admin-password-change','changePassword')->name('admin.password.change')->middleware('role:admin');
    Route::post('/admin-password-change','storePassword')->name('admin.password.change')->middleware('role:admin');

});
//Vendor Routes
Route::controller(Vendor::class)->group(function(){
    Route::get('/vendor-dashboard','dashboard')->name('vendor.dashboard')->middleware('role:vendor');
    //Vendor Profile
    Route::get('/vendor-profile','vendorProfile')->name('vendor.profile')->middleware('role:vendor');
    Route::post('/vendor-update','updateProfile')->name('vendor.update.profile')->middleware('role:vendor');
    //vendor Password
    Route::get('/change-password','passwordChange')->name('vendor.password.change')->middleware('role:vendor');
    Route::post('/change-password','passwordStore')->name('vendor.password.change')->middleware('role:vendor');
    //logout
    Route::get('/vendor-log-out','vendorLogout')->name('vendor.logout')->middleware('role:vendor');

});

//User dashboard Routes
Route::controller(User::class)->group(function(){
    Route::get('/user-dashboard','dashboard')->name('user.dashboard')->middleware('role:user');
   

});

});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
