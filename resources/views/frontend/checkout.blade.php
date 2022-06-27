@extends('layouts.front')

@section('title')

Checkout
@endsection

@section('content')
<div class="container mt-3">
    <form action="{{url('place-order')}}" method="POST">
        {{csrf_field()}}
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h6>Basic Details</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">First Name</label>
                            <input type="text" class="form-control fname" value="{{ Auth::user()->fname }}" name="fname" placeholder="Enter First Name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control lname" value="{{ Auth::user()->lname }}" name="lname" placeholder="Enter Last Name">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">email</label>
                            <input type="text" class="form-control email" value="{{ Auth::user()->email }}" name="email" placeholder="Enter Email">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control phone" value="{{ Auth::user()->phone }}" name="phone" placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Address</label>
                            <input type="text" class="form-control address" value="{{ Auth::user()->address }}" name="address" placeholder="Enter Address">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">City</label>
                            <input type="text" class="form-control city" value="{{ Auth::user()->city }}" name="city" placeholder="Enter City">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Pin Code</label>
                            <input type="text" class="form-control pincode" value="{{ Auth::user()->pincode }}" name="pincode" placeholder="Enter Pin Code">
                        </div>
                    </div>
                </div>
            </div>
        </div>
     


              

        <div class="col-md-5">
            <div class="card-body">
                <h6>Order Detail</h6>
                <hr>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>

                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalsum=0;
                        $total = 0; 
                    @endphp
                 @foreach ($cartitems as $item)
                    @if(floatval($item->products->qty) > floatval($item->prod_qty))

                            <tr>
                                <td>{{$item->products->product_name}}</td>
                                <td>{{$item->prod_qty}}</td>
                                <td>{{$item->products->selling_price}}</td>
                                @php
                                    $s=floatval($item->products->selling_price);
                                    $t=floatval($item->prod_qty);
                                    $total = $s * $t ;
                                    $totalsum += $total;
                                @endphp
                      @else
                      <h6>{{$item->products->product_name}} is Out of Stock</h6>
                    @endif

                        </tr>
                @endforeach




                    </tbody>
                </table>
                <input type="hidden" name="payment_mode" value="COD">
                <h6 class="px-2"> Grand Total <span class="float-end">{{$totalsum}}</span> </h6>
                <hr>
                <button type="submit" class="btn btn-success w-100 mb-2">Place Order | COD</button>
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
@section('scripts')
  <script src="https://www.paypal.com/sdk/js?client-id=AVxfgvT60btVg_TRvEbI1pV2LAxJ-TkPdQ5GSLTM2q31d_eoM-kJX_LIMzUd427vjerI6VqBNPRIiyWw"></script>
 
 <script>
  paypal.Buttons({
  createOrder: function(data, actions) {
    // This function sets up the details of the transaction, including the amount and line item details.
    return actions.order.create({
      purchase_units: [{
        amount: {
          value: '{{$totalsum}}'
        }
      }]
    });
  },
  onApprove: function(data, actions) {
    // This function captures the funds from the transaction.
    return actions.order.capture().then(function(details) {
      // This function shows a transaction success message to your buyer.
      //alert('Transaction completed by ' + details.payer.name.given_name);
       var fname = $('.fname').val();
       var lname = $('.lname').val();
       var email = $('.email').val();
       var phone = $('.phone').val();
       var address = $('.address').val();
       var city =  $('.city').val();
       var pincode = $('.pincode').val();
       //var payment_mode = $('.firstname').val();
       //var payment_id = $('.firstname').val();
       $.ajaxSetup({

headers: {

 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

}

});
      $.ajax({
        method: "POST",
          url: "/place-order",
          data: {
                'fname':fname,
                'lname':lname,
                'email':email,
                'phone':phone,
                'address':address,
                'city':city,
                'pincode':pincode,
                'payment_mode':"Paid by Paypal",
                'payment_id':details.id,

          },
          success: function (response) {
            swal(response.status); 
          }
      });
    });
  }
}).render('#paypal-button-container');
//This function displays payment buttons on your web page.

    
</script>











@endsection
