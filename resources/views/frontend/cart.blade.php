@extends('layouts.front')

@section('title')
My Cart
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
        <a href="{{url('/')}}">
            Home
        </a>/
        <a href="{{ url('cart') }}">
            cart
        </a>/
       
        </h6>
    </div>
</div>

<div class="container my-5">
<div class="card shadow ">
<div class="card-body">
@php
$totalsum=0;
 $total = 0; 
 @endphp
@foreach ($cartitems as $item)


<div class="row product_data">
    <div class="col-md-2 my-auto">
       <img src="{{asset('storage/post/products/'.$item->products->image)}}" height ="70px" weidth="70px" alt="Image Here">

    </div>
    <div class="col-md-3 my-auto">
        <h5>{{$item->products->product_name}}</h5>
    </div>
    <div class="col-md-2 my-auto">
        <h6>Price: {{$item->products->selling_price}}</h6>
    </div>

    <table id="basket" class="table table-hover table-condensed">
    <tbody>
    <tr>
            <td>
    <div class="col-md-3">
        <input type="hidden"  class="prod_id" value="{{$item->prod_id}}" >
    @if(floatval($item->products->qty) > floatval($item->prod_qty))
        <label for="Quantity">Quantity</label>
        <div class="input-group text-center mb-3" style="width:130px; ">
            <button class="input-group-text changeQuantity decrement-btn ">-</button>
            <input type="text" name="quantity " class="form-control qty-input text-center" value="{{$item->prod_qty}}">
            <button class="input-group-text changeQuantity increment-btn" >+</button>       

        </div>
        @php
            $s=floatval($item->products->selling_price);
            $t=floatval($item->prod_qty);
            $total = $s * $t ;
            $totalsum += $total;
        @endphp
        @else
        <h6>Out of Stock</h6>
 @endif
</td>
    </div>
    <td>
        <div class="col-md-2">
            <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Remove</button>
        </div>
</td>
</tr>
</tbody>
</table>
    
</div>



@endforeach 

</div>
<div class="card-footer">
    <h6>Total Price:{{$totalsum}}</h6>
    <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed to checkout</a>
</div>
</div>

</div>

@endsection
@section('scripts')

<script>
$(document).ready(function () {
    $('.addToCartBtn').click(function (e) { 
        e.preventDefault();
        var product_id= $(this).closest('.product_data').find('.prod_id').val();
        var product_qty= $(this).closest('.product_data').find('.qty-input').val();
        
        $.ajaxSetup({

headers: {

 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});
        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data:{
            'product_id':product_id,
            'product_qty':product_qty,


            } ,
            
            success: function (response) {
               swal(response.status); 
            }
        });
        

        
    });
    $('.increment-btn').click(function (e) { 
        e.preventDefault();
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value,10);
        value = isNaN(value) ? 0 : value ;
        if(value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);        }
    });
    $('.decrement-btn').click(function (e) { 
        e.preventDefault();
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value,10);
        value = isNaN(value) ? 0 : value ;
        if(value > 1)
        {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);        }
    });
    $.ajaxSetup({

            headers: 
            {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

    });
$('.delete-cart-item').click(function (e) { 
    e.preventDefault();
    
    var prod_id=$(this).closest('.product_data').find('.prod_id').val();
    $.ajax({
        method: "POST",
        url: "delete-cart-item",
        data: {
            'prod_id':prod_id,
        },
       
        success: function (response) {
            window.location.reload();
            swal("",response.status,"success"); 

        }
    });
    
});
$('.changeQuantity').click(function (e) { 
    e.preventDefault();
    var prod_id=$(this).closest('.product_data').find('.prod_id').val();
    var qty=$(this).closest('.product_data').find('.qty-input').val();
    data={
        'prod_id': prod_id,
        'prod_qty': qty,
    }
$.ajax({
    method: "POST",
    url: "update-cart",
    data: data,
   success: function (response) {
    window.location.reload();
    }
});
    
});


});




</script>
@endsection









         
         