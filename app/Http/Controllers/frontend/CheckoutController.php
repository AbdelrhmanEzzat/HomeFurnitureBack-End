<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\User;
use App\Models\OrderItem;
use  App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartitems as $item)
        if (!Product::where('prod_id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
        {
            $removeItem=Cart::where('user_id',$Auth::id())->where('prod_id',$item->prod_id)->first();
         $removeItem->delete();
        }
       
        $cartitems= Cart::where('user_id',Auth::id())->get();
       return view('frontend.checkout',compact('cartitems'));
    }
   
    public function placeorder(Request $request)
    {
        $order = new Orders();
        $order -> user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->pincode = $request->input('pincode');
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');

        $order->tracking_no = 'demi'.rand(1111,9999);
        $order->save();

        $cartitems = Cart::where('user_id', Auth::id())->get();

        foreach($cartitems as $item)
        {
           OrderItem::create([
            'order_id'=> $order->id,
            'prod_id'=> $item->prod_id,
            'qty'=> $item->prod_qty,
            'price'=> $item->products->selling_price,

           ]);
           $prod = Product::where('prod_id',$item->prod_id)->first();
           $prod->qty = $prod->qty -  $item->prod_qty;
           $prod->update();

        }
if(Auth::user()->address == NULL)
{
   // if(is_null($this->user)){
      //  return "-";
    //}//not from video
    $user = User::where('id', Auth::id())->first();
    
    $user->name = $request->input('fname');
    $user->lname = $request->input('lname');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    $user->city = $request->input('city');
    $user->pincode = $request->input('pincode');
    $order->update();



}
$cartitems = Cart::where('user_id', Auth::id())->get();
    Cart::destroy($cartitems);
    if($request->input('payment_mode')=="Paid by Paypal")
    {
        return response()->json(['status'=>"Order Placed Successfully"]);

    }

    return redirect('/')->with('status',"Order Placed Successfully");


        
    }





}
