<?php

use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\AdminCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCouponController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FronEndController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[FronEndController::class,'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [AdminController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
// ==================category rout====================
Route::get('/category/index',[AdminCategoryController::class,'index'])->name('category.index');
Route::post("/category/store",[AdminCategoryController::class,'categoryStore'])->name('category.store');
Route::get('/category/edit/{id}',[AdminCategoryController::class,'Edit']);
Route::post('/category/update/{id}',[AdminCategoryController::class,'Update']);
Route::get('/category/delete/{id}',[AdminCategoryController::class,'Delete']);
Route::get('/category/inactive/{id}',[AdminCategoryController::class,'Inactive']);
Route::get('/category/active/{id}',[AdminCategoryController::class,'Active']);
// ========================brand================
Route::get('/brand/index',[AdminBrandController::class,'index'])->name('brand.index');
Route::post("/brand/store",[AdminBrandController::class,'brandStore'])->name('brand.store');
Route::get('/brand/edit/{id}',[AdminBrandController::class,'Edit']);
Route::post('/brand/update/{id}',[AdminBrandController::class,'Update']);
Route::get('/brand/delete/{id}',[AdminBrandController::class,'Delete']);
Route::get('/brand/inactive/{id}',[AdminBrandController::class,'Inactive']);
Route::get('/brand/active/{id}',[AdminBrandController::class,'Active']);
// ============================Product===========
Route::get('/admin/add/products',[AdminProductController::class,'getindex'])->name('add.product');
Route::post('/admin/store/products',[AdminProductController::class,'storeproduct'])->name('store.product');
Route::get('/admin/manage/products',[AdminProductController::class,'manageProducts'])->name('manage.product');
Route::get('/admin/product/inactive/{id}',[AdminProductController::class,'productInactive']);
Route::get('/admin/product/active/{id}',[AdminProductController::class,'productActive']);
Route::get('/admin/product/edit/{id}',[AdminProductController::class,'productEdit']);
Route::post('/admin/update/product/{id}',[AdminProductController::class,'updateproduct']);
Route::post('/admin/update/image',[AdminProductController::class,'updateImage'])->name('update.image');
Route::get('admin/product/delete/{id}',[AdminProductController::class,'destroy']);

// =======================coupons======================

Route::get('/coupon/index',[AdminCouponController::class,'index'])->name('coupon.index');
Route::post("/coupon/store",[AdminCouponController::class,'Store'])->name('coupon.store');
Route::get('/coupon/delete/{id}',[AdminCouponController::class,'Delete']);
Route::get('/coupon/edit/{id}',[AdminCouponController::class,'Edit']);
Route::post('/coupon/update/{id}',[AdminCouponController::class,'Update']);
Route::get('/coupon/inactive/{id}',[AdminCouponController::class,'Inactive']);
Route::get('/coupon/active/{id}',[AdminCouponController::class,'Active']);
// ===========================fornend route============
// ===========================cart==================
Route::post('add/ToCart/{id}',[CartController::class,'addToCart']);
