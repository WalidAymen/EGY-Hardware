<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BrandController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\CatController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api','auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/index',[ProductController::class,'index']);
Route::get('/products',[ProductController::class,'index']);
Route::get('/products/show/{id}',[ProductController::class,'show']);

Route::post('/addtocart/{id}',[CartController::class,'add'])->middleware('auth:sanctum');
Route::get('/deletefromcart/{id}',[CartController::class,'dropFromCart'])->middleware('auth:sanctum');
Route::get('/clearcart',[CartController::class,'clearCart'])->middleware('auth:sanctum');
Route::get('/showcart',[CartController::class,'show'])->middleware('auth:sanctum');

Route::get('/cat/{id}',[CatController::class,'show']);

Route::get('/brand/{id}',[BrandController::class,'show']);

Route::get('/showorders',[AuthController::class,'showorders'])->middleware('auth:sanctum');
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('/showreturnrequests',[AuthController::class,'returnOrders'])->middleware('auth:sanctum');
Route::post('/editinfo',[AuthController::class,'editInfo'])->middleware('auth:sanctum');
Route::post('/changepassword',[AuthController::class,'changePassword'])->middleware('auth:sanctum');
Route::post('/modifyaddress',[AuthController::class,'modifyAddress'])->middleware('auth:sanctum');

Route::get('/submitorder',[OrderController::class,'confirmOrder'])->middleware('auth:sanctum');
Route::get('/showorder/{id}',[OrderController::class,'show'])->middleware('auth:sanctum');
Route::get('/returnorder/{id}',[OrderController::class,'return'])->middleware('auth:sanctum');

Route::post('/createmessage',[MessageController::class,'create'])->middleware(['auth:sanctum']);


Route::get('/admin/pindingorders',[OrderController::class,'pindingOrders'])->middleware(['auth:sanctum','api_isBK']);
Route::get('/admin/allorders',[OrderController::class,'allOrders'])->middleware(['auth:sanctum','api_isBK']);
Route::get('/admin/deleteorder/{id}',[OrderController::class,'delete'])->middleware(['auth:sanctum','api_isBK']);
Route::get('/admin/dropfromorder/{oid}/{pid}',[OrderController::class,'drop'])->middleware(['auth:sanctum','api_isBK']);
Route::post('/admin/updateorder/{id}',[OrderController::class,'update'])->middleware(['auth:sanctum','api_isBK']);
Route::get('/admin/showorder/{id}',[OrderController::class,'adminShow'])->middleware(['auth:sanctum','api_isBK']);
Route::get('/admin/returnrequest',[OrderController::class,'returnOrders'])->middleware(['auth:sanctum','api_isBK']);

Route::get('/admin/allmessages',[MessageController::class,'all'])->middleware(['auth:sanctum','api_isBK']);
Route::get('/admin/deletemessage/{id}',[MessageController::class,'delete'])->middleware(['auth:sanctum','api_isBK']);

Route::post('/admin/addproduct',[ProductController::class,'addProduct'])->middleware(['auth:sanctum','api_isAdmin']);
Route::get('/admin/deleteproduct/{id}',[ProductController::class,'deleteProduct'])->middleware(['auth:sanctum','api_isAdmin']);
Route::post('/admin/editproduct/{id}',[ProductController::class,'editProduct'])->middleware(['auth:sanctum','api_isAdmin']);

Route::get('/admin/cats',[CatController::class,'all'])->middleware(['auth:sanctum','api_isAdmin']);
Route::get('/admin/deletecat/{id}',[CatController::class,'delete'])->middleware(['auth:sanctum','api_isAdmin']);
Route::post('/admin/editcat/{id}',[CatController::class,'edit'])->middleware(['auth:sanctum','api_isAdmin']);
Route::post('/admin/addcat',[CatController::class,'add'])->middleware(['auth:sanctum','api_isAdmin']);

Route::get('/admin/brands',[BrandController::class,'all'])->middleware(['auth:sanctum','api_isAdmin']);
Route::get('/admin/deletebrand/{id}',[BrandController::class,'delete'])->middleware(['auth:sanctum','api_isAdmin']);
Route::post('/admin/editbrand/{id}',[BrandController::class,'edit'])->middleware(['auth:sanctum','api_isAdmin']);
Route::post('/admin/addbrand',[BrandController::class,'add'])->middleware(['auth:sanctum','api_isAdmin']);

Route::get('/admin/users',[AuthController::class,'all'])->middleware(['auth:sanctum','api_isSuperAdmin']);
Route::post('/admin/adduser',[AuthController::class,'adminAdd'])->middleware(['auth:sanctum','api_isSuperAdmin']);
Route::post('/admin/edituser/{id}',[AuthController::class,'adminEdit'])->middleware(['auth:sanctum','api_isSuperAdmin']);
Route::post('/admin/deleteuser/{id}',[AuthController::class,'delete'])->middleware(['auth:sanctum','api_isSuperAdmin']);

