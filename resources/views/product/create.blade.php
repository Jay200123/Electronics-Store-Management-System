@extends('layouts.base')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>



<div class="card push-top">
  <div class="card-header">
    Add New Record
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    
      <form method="post" action="{{ route('products.store') }}" enctype ="multipart/form-data">
        @csrf
          <div class="form-group">
              @csrf
              <label for="escription">Product Description</label>
              <input type="text" class="form-control" name="description" id="description"/>
           </div>
    
          <div class="form-group">
              <label for="cost_price">Cost Price</label>
              <input type="number" class="form-control" name="cost_price" id="cost_price"/>
          </div>

          <div class="form-group">
              <label for="sell_price">Sell Price</label>
              <input type="number" class="form-control" name="sell_price" id="sell_price"/>
          </div>

          <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="quantity"/>
          </div>

          <div class="form-group">
          <label for="image" class="control-label">Product Image</label>
          <input type="file" class="form-control" id="product_image" name="product_image"/>
          @error('images')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
   
  </div>
          <button type="submit" class="btn btn-block btn-danger">Add New Product</button>
      </form>
  </div>

</div>
@endsection