<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller\CategoryController;
use App\Http\Controllers\Controller\ProductController;
use App\Http\Controllers\Controller\frontend\frontendController;
use App\Http\Controllers\Controller\frontend\CartController;





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

Route::get('/', [App\Http\Controllers\frontend\frontendController::class, 'index']);
Route::get('category', [App\Http\Controllers\frontend\frontendController::class, 'category']);
Route::get('view-category/{slug}', [App\Http\Controllers\frontend\frontendController::class, 'viewcategory']);

Route::get('category/{cate_slug}/{prod_slug}', [App\Http\Controllers\frontend\frontendController::class, 'productview']);


//add-to-cart






Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('add-to-cart', [App\Http\Controllers\frontend\CartController::class, 'addProduct']);


//Route::middleware(['auth'])->group(function(){

//});
//



Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard','Admin\FrontendController@index');
    Route::get('categories','Admin\CategoryController@index');
    Route::get('add-category','Admin\CategoryController@add');
    Route::post('insert-category','Admin\CategoryController@insert');
    Route::get('edit-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'edit']);
    Route::put('update-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'update']);
    Route::get('delete-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'destroy']);

    Route::get('products',[App\Http\Controllers\Admin\ProductController::class,'index']);
    Route::get('add-products',[App\Http\Controllers\Admin\ProductController::class,'add']);
    Route::post('insert-product',[App\Http\Controllers\Admin\ProductController::class,'insert']);
    Route::get('edit-product/{prod_id}',[App\Http\Controllers\Admin\ProductController::class,'edit']);
    Route::put('update-product/{prod_id}',[App\Http\Controllers\Admin\ProductController::class,'update']);
    Route::get('delete-product/{prod_id}',[App\Http\Controllers\Admin\ProductController::class,'destroy']);








    });

    // Route::middleware(['auth','isDesigner'])->group(function(){
    //     Route::get('/', [App\Http\Controllers\frontend\frontendController::class, 'index']);

    // });





    //Route::get('/', [App\Http\Controllers\frontend\frontendController::class, 'index']);
    //isDesigner
    //php artisan cache:clear
    //
//php artisan route:cache
//php artisan config:cache
//php artisan view:clear












