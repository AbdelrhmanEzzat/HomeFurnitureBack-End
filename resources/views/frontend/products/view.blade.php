@extends('layouts.front')

@section('title',$products->product_name)


@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
      <h6 class="mb-0">   Collections/{{$products->category->category_name}} / {{$products->product_name}} </h6> 
    </div>
</div>
<div class="container">
      <div class="card shadow product_data">
         <div class="card-body">
                        <div class="row">
                                        <div class="col-md-4 border-right">
                                        <img src="{{asset('storage/post/products/'.$products->image)}}" class="w-100" alt="">

                                        </div>
                               <div class="col-md-8">
                                            <h2 class="mb-0">
                                                {{$products->product_name}}
                                                @if($products->trending=='1')
                                                <label style="font-size: 16px;" class="float-end badge bg-danger tranding_tag">Trending</label>
                                                @endif
                                        </h2>
                                
                                            <hr>
                                            <label class="me-3">Original Price:<s>Rs {{$products->original_price}}</s></label>
                                            <label class="fw-bold">Selling Price:Rs {{$products->selling_price}}</label>

                                                                        <!-- <p class="mt-3">
                                                                            {!! $products->small_description !!}

                                                                        </p>
                                                                        <hr> -->
                                  <p class="mt-3">
                                             <h4>Post Description</h4>
                                                                            {!! $products->description !!}

                                                                        </p>
                                                                        
                                            <hr>
                                            @if($products->qty>0)
                                            <label class="badge bg-success">In stock</label>
                                            @else
                                            <label class="badge bg-danger">Out of stock</label>
                                            @endif
                                            <div class="row mt-2">
                                                <div class="col-md-3">
                                                    <input type="hidden" value="{{$products->prod_id}}" class="prod_id">
                                                    <label for="Quantity">Quantity</label>
                                                    <div class="input-group text-center mb-3" style="width:100px; ">
                                                        <button class="input-group-text  decrement-btn">-</button>
                                                        <input type="text" name="quantity " class="form-control qty-input text-center"  value="1">
                                                        <button class="input-group-text increment-btn">+</button>

                                                    </div>
                                                </div>

                                            <div class="col-md-10">
                                            <br/>
                                            @if($products->qty>0)
                                            <label class="badge bg-success">In stock</label>
                                            <button type="button" class="btn btn-success me-3 addToCartBtn float-start">Add to Cart</button>

                                           
                                            @endif
                                            <button type="button" class="btn btn-success me-3 float-start">Add to Wishlist</button>




                                  </div>
                                  


                            </div>







                        </div>
    
                    </div>

        
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
           var inc_value = $('.qty-input').val();
           var value = parseInt(inc_value,10);
           value = isNaN(value) ? 0 : value ;
           if(value < 10)
           {
               value++;
               $('.qty-input').val(value);
           }
       });
       $('.decrement-btn').click(function (e) { 
           e.preventDefault();
           var inc_value = $('.qty-input').val();
           var value = parseInt(inc_value,10);
           value = isNaN(value) ? 0 : value ;
           if(value > 1)
           {
               value--;
               $('.qty-input').val(value);
           }
       });
   });
</script>
@endsection

