<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Product;

class FrontendController extends Controller
{
  public function index()
  {


    $featured_products= Product::Where('trending','1')->take(5)->get();

      return view ('frontend.index',compact('featured_products'));
  }
}
