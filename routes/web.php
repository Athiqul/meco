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
    Route::get('/admin-dashboard','dashboard')->name('admin.dashboard')->middleware('role:admin');

});
//Vendor Routes
Route::controller(Vendor::class)->group(function(){
    Route::get('/vendor-dashboard','dashboard')->name('vendor.dashboard')->middleware('role:vendor');

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