@extends('layouts.admin')


@section('content')

<div class="card">
<div class="card-header">
<h4> Posts Page </h4>
<hr>
</div>
<div class="card-body">
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Name</th>
            <th>Selling Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $item)
        <tr>
            <td>{{ $item->prod_id}}</td>
            <td>{{ $item->category->category_name }}</td>
            <td>{{ $item->product_name }}</td>
            <td>{{ $item->selling_price }}</td>
            <td>
                <img src="{{asset('storage/post/products/'.$item->image) }}" class="w-50" alt="Image here"> 
            </td>
            <td>
                <a href="{{ url('edit-product/'.$item->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ url('delete-product/'.$item->id) }}" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

</div>
@endsection