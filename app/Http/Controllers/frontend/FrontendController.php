<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Product;
use  App\Models\Category;

class FrontendController extends Controller
{
  public function index()
  {


    $featured_products= Product::Where('trending','1')->take(5)->get();

      return view ('frontend.index',compact('featured_products'));
  }

  public function category()
  {
    $category= Category::where ('status','0')->get();
    return view ('frontend.category',compact('category')); 
   }
}
