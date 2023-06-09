<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Vendor;
use App\Http\Controllers\User;
use App\Http\Controllers\Home;
use App\Http\Controllers\Module\Brand;
use App\Http\Controllers\Module\Category;
use App\Http\Controllers\Module\SubCategoryController;
use App\Http\Controllers\Module\VendorApprove;
use App\Http\Controllers\Module\Product;
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
//For vendor and admin login
Route::get('/enterprise-login', function () {
    return view('auth.enterprise_login');
});
//All Users
Route::middleware('verify')->group(function () {
    //Admin Routes
    Route::controller(Admin::class)->group(function () {
        //render admin dashboard
        Route::get('/admin-dashboard', 'dashboard')->name('admin.dashboard')->middleware('role:admin');
        //admin logout
        Route::get('/admin-logout', 'destroy')->name('admin.logout')->middleware('role:admin');
        //admin profile
        Route::get('/admin-profile', 'adminProfile')->name('admin.profile')->middleware('role:admin');
        //Admin Profile Update
        Route::post('/admin-profile-update', 'adminUpdate')->name('admin.profile.update')->middleware('role:admin');
        //Admin Password Change
        Route::get('/admin-password-change', 'changePassword')->name('admin.password.change')->middleware('role:admin');
        Route::post('/admin-password-change', 'storePassword')->name('admin.password.change')->middleware('role:admin');
    });
    //Vendor Routes
    Route::controller(Vendor::class)->group(function () {
        Route::get('/vendor-dashboard', 'dashboard')->name('vendor.dashboard')->middleware('role:vendor');
        //Vendor Profile
        Route::get('/vendor-profile', 'vendorProfile')->name('vendor.profile')->middleware('role:vendor');
        Route::post('/vendor-update', 'updateProfile')->name('vendor.update.profile')->middleware('role:vendor');
        //vendor Password
        Route::get('/change-password', 'passwordChange')->name('vendor.password.change')->middleware('role:vendor');
        Route::post('/change-password', 'passwordStore')->name('vendor.password.change')->middleware('role:vendor');
        //logout
        Route::get('/vendor-log-out', 'vendorLogout')->name('vendor.logout')->middleware('role:vendor');
    });


});

   //User dashboard Routes
   Route::middleware('auth')->group(function(){
    Route::controller(User::class)->group(function () {
        Route::get('/user-dashboard', 'dashboard')->name('user.dashboard')->middleware('role:user');
        //user logout
        Route::get('/user-logout', 'userLogout')->name('user.logout')->middleware('role:user');
        Route::post('/user-info-update', 'infoStore')->name('user.update')->middleware('role:user');
        Route::post('/change-password', 'changePassword')->name('user.password.change')->middleware('role:user');
    });
   });


//Admin view
Route::middleware(['auth', 'role:admin'])->group(function () {

    //All Brand Admin Route
    Route::controller(Brand::class)->group(function () {
        route::get('/brand-list', 'index')->name('admin.brand.list');
        route::get('/create-brand', 'create')->name('admin.brand.create');
        route::post('/brand-store', 'store')->name('admin.brand.store');
        route::get('/brand-edit/{id}', 'edit')->name('admin.brand.edit');
        route::post('/brand-update/{id}', 'update')->name('admin.brand.update');
        route::get('/brand-delete/{id}', 'deleteBrand')->name('admin.brand.delete');
    });
    //Category Admin Route
    Route::controller(Category::class)->group(function () {
        route::get('/category-list', 'index')->name('admin.category.list');
        route::get('/create-category', 'create')->name('admin.category.create');
        route::post('/category-store', 'store')->name('admin.category.store');
        route::get('/category-edit/{id}', 'edit')->name('admin.category.edit');
        route::post('/category-update/{id}', 'update')->name('admin.category.update');
        route::get('/category-delete/{id}', 'deleteCategory')->name('admin.category.delete');
    });
    //Sub Category Admin Route
    Route::controller(SubCategoryController::class)->group(function () {
        route::get('/sub-category-list', 'index')->name('admin.subcategory.list');
        route::get('/sub-create-category', 'create')->name('admin.subcategory.create');
        route::post('/sub-category-store', 'store')->name('admin.subcategory.store');
        route::get('/sub-category-edit/{id}', 'edit')->name('admin.subcategory.edit');
        route::post('/sub-category-update/{id}', 'update')->name('admin.subcategory.update');
        route::get('/subcategory-delete/{id}', 'deleteSubCategory')->name('admin.subcategory.delete');
    });

    Route::controller(VendorApprove::class)->group(function () {
        route::get('/active-vendors', 'activeVendors')->name('admin.active.vendors');
        route::get('/inactive-vendors', 'inactiveVendors')->name('admin.inactive.vendors');
        route::get('/vendor-profile/{id}', 'vendorProfile')->name('admin.vendor.profile');
        route::get('/vendor-approval/{id}', 'vendorApproval')->name('admin.vendor.status');

    });

    //Product
    Route::controller(Product::class)->group(function () {
        route::get('/products-list', 'index')->name('admin.product.list');

        route::get('/add-product', 'addProduct')->name('admin.product.add');
        route::get('/vendor-profile/{id}', 'vendorProfile')->name('admin.vendor.profile');
        route::get('/vendor-approval/{id}', 'vendorApproval')->name('admin.vendor.status');

    });

});




//Customer View
Route::get('/', [Home::class, 'index'])->name('customer.home');
//Vendor Registration
Route::get('/become-vendor', [VendorApprove::class, 'vendorRegister'])->name('vendor.signup');
Route::post('/vendor-signup', [Vendor::class, 'registerVendor'])->name('vendor.register');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
