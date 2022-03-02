<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller\CategoryController;
use App\Http\Controllers\Controller\ProductController;
use App\Http\Controllers\Controller\frontend\frontendController;





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





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard','Admin\FrontendController@index');
    Route::get('categories','Admin\CategoryController@index');
    Route::get('add-category','Admin\CategoryController@add');
    Route::post('insert-category','Admin\CategoryController@insert');
    Route::get('edit-category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'edit']);
    Route::put('update-category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'update']);
    Route::get('delete-category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'destroy']);

    Route::get('products',[App\Http\Controllers\Admin\ProductController::class,'index']);
    Route::get('add-products',[App\Http\Controllers\Admin\ProductController::class,'add']);
    Route::post('insert-product',[App\Http\Controllers\Admin\ProductController::class,'insert']);
    Route::get('edit-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'edit']);
    Route::put('update-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'update']);
    Route::get('delete-product/{id}',[App\Http\Controllers\Admin\ProductController::class,'destroy']);








    });
    //php artisan cache:clear
//php artisan route:cache
//php artisan config:cache
//php artisan view:clear












