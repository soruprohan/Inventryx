<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\WareHouseController;

Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

 Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');


 Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});


 Route::middleware('auth')->group(function () {
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');  
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');  

    });
    
    Route::controller(WareHouseController::class)->group(function(){
        Route::get('/all/warehouse', 'AllWareHouse')->name('all.warehouse');
        Route::get('/add/warehouse', 'AddWareHouse')->name('add.warehouse');
        Route::post('/store/warehouse', 'StoreWareHouse')->name('store.warehouse');
        Route::get('/edit/warehouse/{id}', 'EditWareHouse')->name('edit.warehouse');
        Route::post('/update/warehouse', 'UpdateWareHouse')->name('update.warehouse');  
        Route::get('/delete/warehouse/{id}', 'DeleteWareHouse')->name('delete.warehouse');  

    });
});