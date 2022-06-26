<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(Type $var = null)
    {
        $category=  Category::all();
        return view('admin.category.index',compact('category'));
    }
   
    public function add()
    {
        return view('admin.category.add');
    }
    public function insert(Request $request)
    {
       $category= new Category();

       if($request->hasFile('image')){

        $file = $request->file('image');
        $ext = $file->getClientOriginalName();
        $filename = time().'.'.$ext;
        $file->move('storage/post/',$filename);
        $category->image= $filename;
        
            }
            $category->category_name = $request->input('category_name');
            $category->slug = $request->input('slug');
            $category->description = $request->input('description');
           $category->status = $request->input('status') == TRUE ? '1':'0';
            $category->popular = $request->input('popular') == TRUE? '1':'0';
            $category->meta_title = $request->input('meta_title');
            $category->meta_keywords = $request->input('meta_keywords');

           $category->meta_descrip = $request->input('meta_description');

            $category->save();
             
            return redirect('/dashboard')->with('status',"Category Added Successfully");
// -----------------------------------------------------------------------------------
            // if($request->hasFile('image')){

            //     $file = $request->image;
            //     $new_file=time().$file->getClientOriginalName();
            //     $file->move('storage/post',$new_file);
                
            //         }
                
            //           //by this function we store info we get from the user by the function create (including form in the front end)
            //           //dd($request->all());
            //           Category::create([
            //     "name"=>$request->name,
            //     "slug"=>$request->slug,
            //     "image"=>'storage/post/'.$new_file,
            //     "description"=>$request->description,
            //     "status"=>$request->status == TRUE ? '1':'0',
            //     "popular"=>$request->popular == TRUE ? '1':'0',
            //     "meta_title"=>$request->meta_title,
            //     "meta_descrip"=>$request->meta_description,
            //     "meta_keywords"=>$request->meta_keywords,
            //     //eli 3ala el shmal hwa bta3 el database
                
                

               

                
            //     ]);
                
                
            //     return redirect('/dashboard')->with('status',"Category Added Successfully");
                //return redirect()->back();

    }


public function edit($id)
{
     $category=  Category::find($id);
    return view('admin.category.edit',compact('category'));
}
public function update(Request $request,$id)

{ $category=  Category::find($id);

    if($request->hasFile('image')){

    $path='storage/post/'.$category->image;
    if(File::exists($path)) {
        File::delete($path);

    }
           $file = $request->file('image');
           $ext = $file->getClientOriginalName();
            $filename = time().'.'.$ext;
            $file->move('storage/post/',$filename);
            $category->image= $filename;

        }
                   $category->category_name = $request->input('category_name');
                    $category->slug = $request->input('slug');
                    $category->description = $request->input('description');
                   $category->status = $request->input('status') == TRUE ? '1':'0';
                    $category->popular = $request->input('popular') == TRUE? '1':'0';
                    $category->meta_title = $request->input('meta_title');
                    $category->meta_keywords = $request->input('meta_keywords');
        
                   $category->meta_descrip = $request->input('meta_description');
        
                    $category->update();
                    return redirect('/dashboard')->with('status',"Category updated Successfully");


}
 function destroy($id)
{
    $category=  Category::find($id);
    if($category->image){

        $path='storage/post/'.$category->image;
        if(File::exists($path)) {
            File::delete($path);
    
        }
    }
    $category->delete();
    return redirect('categories')->with('status',"Category Deleted Successfully");


}



}
