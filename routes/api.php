<?php
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\ItemsController;
use App\Http\Controllers\api\MediaController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\PostsController;
use App\Http\Controllers\api\Product_imgController;
use App\Http\Controllers\api\RatingController;
use App\Models\Media;
use App\Models\Post;
use App\Models\Product_image;
use App\Models\Rating;
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
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/posts',[PostsController::class,'index']);
Route::get('/Rating',[RatingController::class,'index']);
Route::get('/orders',[OrderController::class,'index']);
Route::get('/items',[ItemsController::class,'index']);
Route::get('/contacts',[ContactController::class,'index']);
Route::get('/media',[MediaController::class,'index']);
Route::get('/proimg',[Product_imgController::class,'index']);


//Protected routes
Route::group(['middleware'=> ['auth:sanctum']], function(){




});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
