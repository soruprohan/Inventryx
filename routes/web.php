<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\WareHouseController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PurchaseController;

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

    Route::controller(SupplierController::class)->group(function(){
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'StoreSupplier')->name('store.supplier');
        Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier');
        Route::post('/update/supplier', 'UpdateSupplier')->name('update.supplier');  
        Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier');  

    });

    Route::controller(CustomerController::class)->group(function(){
        Route::get('/all/customer', 'AllCustomer')->name('all.customer');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('/store/customer', 'StoreCustomer')->name('store.customer');
        Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
        Route::post('/update/customer', 'UpdateCustomer')->name('update.customer');
        Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');

    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');

    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
        Route::get('/details/product/{id}', 'DetailsProduct')->name('details.product');

    });

    Route::controller(PurchaseController::class)->group(function(){
        Route::get('/all/purchase', 'AllPurchase')->name('all.purchase');
        Route::get('/add/purchase', 'AddPurchase')->name('add.purchase');
        Route::get('/purchase/product/search', 'PurchaseProductSearch')->name('purchase.product.search');
        Route::post('/store/purchase', 'StorePurchase')->name('store.purchase');
        Route::get('/edit/purchase/{id}', 'EditPurchase')->name('edit.purchase');
        Route::post('/update/purchase/{id}', 'UpdatePurchase')->name('update.purchase');
        Route::get('/delete/purchase/{id}', 'DeletePurchase')->name('delete.purchase');
        Route::get('/details/purchase/{id}', 'DetailsPurchase')->name('details.purchase');
        Route::get('/invoice/purchase/{id}', 'InvoicePurchase')->name('invoice.purchase');
    });
});