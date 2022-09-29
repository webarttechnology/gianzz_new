<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategaryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderHistoryController;
use App\Http\Controllers\admin\CsvProductController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\SlideController;

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

Route::get('/author', function () {
    return view('admin.login');
});


Route::post('author/login',[UserController::class,'login']);
Route::get('author/logout',[UserController::class,'logout']);
Route::get('author/dashboard',[Usercontroller::class, 'dashboard'])->middleware('is_login');

Route::prefix('/author')-> group(function(){

    Route::get('/forgot',[UserController::class, 'forgotPasseord']);
    Route::post('/forgotpassword',[UserController::class, 'sendVerificationCode']);
    Route::get('/verify-record',[UserController::class, 'Verify_record']);
    Route::post('/verify-record',[Usercontroller::class, 'Check_verification_code']);
    Route::get('/reset-password',[Usercontroller::class, 'reset_password']);
    Route::post('/reset-email',[Usercontroller::class, 'reset_emailPassword']);

    Route::get('/password-change',[Usercontroller::class, 'passwordChange']);
    Route::post('/password-change',[Usercontroller::class, 'passwordChange']);


    Route::get('/category',[CategaryController::class,'list'])->middleware('is_login');
    Route::get('/category/add',[CategaryController::class,'add'])->middleware('is_login');
    Route::post('/category/add',[CategaryController::class,'add'])->middleware('is_login');
    Route::get('/category/upate/{id}',[CategaryController::class,'update'])->middleware('is_login');
    Route::post('/category/update',[CategaryController::class,'update'])->middleware('is_login');
    Route::get('/category/delete/{id}',[CategaryController::class,'delete'])->middleware('is_login');

    Route::get('/subcategory',[SubCategoryController::class,'list'])->middleware('is_login');
    Route::get('/subcategory/add',[SubCategoryController::class,'add'])->middleware('is_login');
    Route::post('/subcategory/add',[SubCategoryController::class,'add'])->middleware('is_login');
    Route::get('/subcategory/upate/{id}',[SubCategoryController::class,'update'])->middleware('is_login');
    Route::post('/subcategory/update',[SubCategoryController::class,'update'])->middleware('is_login');
    Route::get('/subcategory/delete/{id}',[SubCategoryController::class,'delete'])->middleware('is_login');

    Route::get('/product-discount',[DiscountController::class,'list'])->middleware('is_login');
    Route::get('/product-discount/add',[DiscountController::class,'add'])->middleware('is_login');
    Route::post('/product-discount/add',[DiscountController::class,'add'])->middleware('is_login');
    Route::get('/product-discount/upate/{id}',[DiscountController::class,'update'])->middleware('is_login');
    Route::post('/product-discount/update',[DiscountController::class,'update'])->middleware('is_login');
    Route::get('/product-discount/delete/{id}',[DiscountController::class,'delete'])->middleware('is_login');


    Route::get('/product',[ProductController::class,'list'])->middleware('is_login');
    Route::get('/product/add',[ProductController::class,'add'])->middleware('is_login');
    Route::post('/product/add',[ProductController::class,'add'])->middleware('is_login');
    Route::get('/product/upate/{id}',[ProductController::class,'update'])->middleware('is_login');
    Route::post('/product/update',[ProductController::class,'update'])->middleware('is_login');
    Route::get('/product/delete/{id}',[ProductController::class,'delete'])->middleware('is_login');
    Route::get('/product/getSubCategary',[ProductController::class,'getSubcategary'])->middleware('is_login');

    Route::get('/home-slide',[SlideController::class,'list'])->middleware('is_login');
    Route::get('/home-slide/add',[SlideController::class,'add'])->middleware('is_login');
    Route::post('/home-slide/add',[SlideController::class,'add'])->middleware('is_login');
    Route::get('/home-slide/upate/{id}',[SlideController::class,'update'])->middleware('is_login');
    Route::post('/home-slide/update',[SlideController::class,'update'])->middleware('is_login');
    Route::get('/home-slide/delete/{id}',[SlideController::class,'delete'])->middleware('is_login');

    Route::get('/csv/product',[CsvProductController::class,'add'])->middleware('is_login');
    Route::post('/csv/product/add',[CsvProductController::class,'fileupload'])->middleware('is_login');

    Route::get('/product/chain-rope/delete/{id}',[ProductController::class,'deleteChainrope'])->middleware('is_login');

    Route::get('/order',[OrderHistoryController::class,'list'])->middleware('is_login');
});