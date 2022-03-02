@extends('layouts.front')

@section('title')

welcome to Freede
@endsection

@section('content')
@include('layouts.inc.slider')

<div class="py-5">
<div class="container">
<div class="row">
    <h2>Featured Products</h2>
    @foreach($featured_products as $prod)
    <div class="col-md-4 mb-3">
        <div class="card">
            <img src="{{asset('storage/post/products/'.$prod->image)}}" alt="product image">
            <div class="card-body">
                <h5>{{$prod->name}} </h5>
                <span class="float-start">{{$prod->selling_price}}</span>
                <span class="float-end"> <s> {{$prod->original_price}} </s></span>
            </div>
            
        </div>
    </div>
    @endforeach
</div>

</div>

</div>








@endsection
