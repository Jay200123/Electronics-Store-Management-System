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
    Update Service's Data
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
      <form method="post" action="{{ route('products.update', $products->id) }}" enctype ="multipart/form-data">

          <div class="form-group">
          @csrf 
              @method('PUT')
              <label for="description">Service Description: </label>
              <input type="text" class="form-control" name="description" value="{{ $products->description }}"/>
          </div>


          <div class="form-group">
              <label for="cost">Product Cost: </label>
              <input type="number" class="form-control" name="cost_price" value="{{ $products->cost_price }}"/>
          </div>

          <div class="form-group">
              <label for="cost">Sell Price: </label>
              <input type="number" class="form-control" name="sell_price" value="{{ $products->sell_price }}"/>
          </div>

          <div class="form-group">
          <label for="image" class="control-label">Product Image:</label>
          <input type="file" class="form-control" id="id" name="product_image" value="{{$products->product_image}}"/>
           @if($errors->has('serv_img'))
           <small>{{ $errors->first('serv_img') }}</small>
           @endif
          </div>

          <button type="submit" class="btn btn-block btn-danger">Update</button>
      </form>
  </div>
</div>
@endsection

<!-- <input type="file" class="custom-file-input" id="images" name="image"> -->