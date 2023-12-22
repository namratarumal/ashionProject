<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendIndexController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\tableController;
use App\Http\Controllers\InwardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\adminController;

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
Route::get('login',[LoginController::class,'login']);
Route::post('loginpage',[LoginController::class,'loginpage']);
Route::get('logout',[LoginController::class,'logout']);
Route::get('indexpage',[FrontendIndexController::class,'indexpage']);
Route::get('shop',[FrontendIndexController::class,'shop']);
Route::get('subProduct/{id}',[FrontendIndexController::class,'subProduct']);
Route::get('productDetail/{id}',[FrontendIndexController::class,'productDetail']);
Route::get('cart/{id}',[FrontendIndexController::class,'AddtoCart']);
Route::get('viewcart',[FrontendIndexController::class,'viewcart']);
Route::get('removecart/{id}',[FrontendIndexController::class,'removecart']);
Route::get('contact',[FrontendIndexController::class,'contact']);
Route::post('contactinsert',[FrontendIndexController::class,'contactinsert']);
Route::get('checkout',[FrontendIndexController::class,'checkout'])->middleware('login');
Route::post('checkoutstore',[FrontendIndexController::class,'checkoutstore']);
Route::post('cartQtyUpdate',[FrontendIndexController::class,'cartQtyUpdate']);

Route::resource('register',registerController::class);
Route::get('index',[indexController::class,'index'])->middleware('adminlogin');
Route::resource('category',CategoryController::class)->middleware('adminlogin');
Route::resource('subcategory',SubCategoryController::class)->middleware('adminlogin');
Route::resource('product',ProductController::class)->middleware('adminlogin');
Route::get('registerdetails',[tableController::class,'registerdetails'])->middleware('adminlogin');
Route::get('shippingdetails',[tableController::class,'shippingdetails'])->middleware('adminlogin');
Route::get('shppingShow/{id}',[tableController::class,'shppingShow'])->middleware('adminlogin');
Route::delete('shoppingDelete/{id}',[tableController::class,'shoppingDelete']);
Route::get('orderdetails',[tableController::class,'orderdetails'])->middleware('adminlogin');
Route::delete('orderDelete/{id}',[tableController::class,'orderDelete']);
Route::resource('inward',InwardController::class)->middleware('adminlogin');
Route::resource('stock',StockController::class)->middleware('adminlogin');
Route::delete('registerDelete/{id}',[tableController::class,'registerDelete']);

Route::get('registerview',[tableController::class,'registerview']);
Route::get('registerexport',[tableController::class,'registerexport']);

Route::get('adminregister',[adminController::class,'adminregister']);
Route::post('/registeruser',[adminController::class,'registeruser'])->name('registeruser');
Route::get('adminlogin',[adminController::class,'adminlogin']);
Route::post('login-user',[adminController::class,'LoginUser'])->name('login-user');
Route::get('adminlogout',[adminController::class,'adminlogout']);