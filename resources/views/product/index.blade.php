@extends('layouts.base')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
 
  <div class="col col-md-6">
    <a href="{{ route('products.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>Add New Product</a>
  </div>

  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Product Description</td>
          <td>Cost Price</td>
          <td>Sell Price</td>
          <td>Product Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $products)
        <tr>
            <td>{{$products->id}}</td>
            <td>{{$products->description}}</td>
            <td>{{$products->cost_price}}</td>
            <td>{{$products->sell_price}}</td>
            <td><img src="{{asset($products->product_image) }}" width = "70px" height="70px"></td>
            <td class="text-center">
            <a href="{{ route('products.edit', $products->id)}}" class = "btn btn-primary btn-sm">Edit</a>
             <form method="post" action="{{ route('products.destroy', $products->id) }}">
                @csrf
                <input type="hidden" name="_method" value="DELETE" />
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection