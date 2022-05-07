<?php
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



// public routes
Route::post('/login',[AuthController::class,'login']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout']);
Route::get('/products',[ProductController::class,'index']);

Route::get('/category',[CategoryController::class,'index']);


//Protected routes
Route::group(['middleware'=> ['auth:sanctum']], function(){




});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
