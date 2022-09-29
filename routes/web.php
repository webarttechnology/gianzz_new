<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RegistrationController;
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

Route::get("/login", [HomeController::class, 'login']);
Route::post("/login", [HomeController::class, 'login']);
Route::get("/logout", [HomeController::class, 'logout']);


Route::get('/my-account',[HomeController::class,'dashboard'])->middleware('is_frontendlogin');
Route::post('/my-account',[HomeController::class,'dashboard'])->middleware('is_frontendlogin');
Route::get('/password-change',[HomeController::class,'passwordchange'])->middleware('is_frontendlogin');
Route::post('/password-change',[HomeController::class,'passwordchange'])->middleware('is_frontendlogin');
Route::get('/edit-profile',[HomeController::class,'profileedit'])->middleware('is_frontendlogin');
Route::post('/edit-profile',[HomeController::class,'profileedit'])->middleware('is_frontendlogin');



Route::get("/", [HomeController::class, 'index']);
Route::get("/registration", [RegistrationController::class, 'registration']);
Route::post("/registration", [RegistrationController::class, 'registration']);
Route::get("/user-verification", [RegistrationController::class, 'userVerification']);
Route::post("/user-verification", [RegistrationController::class, 'userVerification']);
Route::get("/shop", [HomeController::class, 'shop']);
Route::get("/product/{id}", [HomeController::class, 'productDetails']);
Route::get("/product-details-price", [HomeController::class, 'productprice']);

Route::get("/add-to-cart", [CartController::class, 'getaddtocartdata']);
Route::get("/add-cart", [CartController::class, 'addItem']);
Route::get("/remove-cart/{id}", [CartController::class, 'removeItem']);
Route::get("/order-update-quantities", [CartController::class, 'order_update_quantities']);
Route::get("/order-summery", [CartController::class, 'getOrdersummery']);

Route::get("/checkout", [CheckoutController::class, 'checkout']);
Route::post("/check-out", [CheckoutController::class, 'checkout']);