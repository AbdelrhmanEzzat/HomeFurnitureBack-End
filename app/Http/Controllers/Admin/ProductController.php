<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use  App\Models\Product;
use Illuminate\Support\Facades\File;



class ProductController extends Controller
{
    public function index(Type $var = null)
    {
        $products=  Product::all();
        return view('admin.product.index',compact('products'));
    }
    public function add()
    {
        $category=  Category::all();
        return view('admin.product.add',compact('category'));
    }
    public function insert(Request $request)
    {
        
        $products= new Product();
        if($request->hasFile('image')){

            $file = $request->file('image');
            $ext = $file->getClientOriginalName();
            $filename = time().'.'.$ext;
            $file->move('storage/post/products/',$filename);
            $products->image= $filename;
            
                }
                $products->category_id = $request->input('category_id');

                $products->product_name = $request->input('product_name');
                $products->slug = $request->input('slug');
                $products->small_description = $request->input('small_description');
                $products->description = $request->input('description');
                $products->original_price = $request->input('original_price');
                $products->selling_price = $request->input('selling_price') ;
                $products->tax = $request->input('tax') ;
                $products->qty = $request->input('qty') ;
                $products->rate_id = $request->input('rate_id') ;



                $products->status = $request->input('status') == TRUE ? '1':'0';
                $products->trending = $request->input('trending') == TRUE? '1':'0';
                $products->meta_title = $request->input('meta_title');
                $products->meta_keywords = $request->input('meta_keywords');

                $products->meta_descrip = $request->input('meta_description');

                $products->save();
             
            return redirect('products')->with('status',"Post Added Successfully");
    }
    public function edit($prod_id)
{
     $products=  Product::find($prod_id);
    return view('admin.product.edit',compact('products'));
}
public function update(Request $request,$prod_id)

{ $products=  Product::find($prod_id);

    if($request->hasFile('image')){
        $path='storage/post/products/'.$products->image;
        if(File::exists($path)) {
            File::delete($path);
    
        }

   
           $file = $request->file('image');
           $ext = $file->getClientOriginalName();
            $filename = time().'.'.$ext;
            $file->move('storage/post/products/',$filename);
            $products->image= $filename;

        }
        $products->product_name = $request->input('product_name');

        $products->slug = $request->input('slug');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price') ;
        $products->tax = $request->input('tax') ;
        $products->qty = $request->input('qty') ;



        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending') == TRUE? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');

        $products->meta_descrip = $request->input('meta_description');
        
                    $products->update();
                    return redirect('/dashboard')->with('status',"Post updated Successfully");


}
 function destroy($prod_id)
{
    $products=  Product::find($prod_id);
    if($products->image){

        $path='storage/post/products/'.$products->image;
        if(File::exists($path)) {
            File::delete($path);
    
        }
    }
    $products->delete();
    return redirect('products')->with('status',"Post Deleted Successfully");


}
//test
}
