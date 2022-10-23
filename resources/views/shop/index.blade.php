@extends('layouts.base')

@section('title')
Mobile Phones
@endsection
<style>
  .layered-card {
                        position: relative;
                    }

                    .layered-card::before {
                        background: rgba(0, 0, 0, 0.3);
                        content: '';

                        /* Position */
                        top: 0;
                        left: 0;
                        position: absolute;
                        transform: translate(1rem, 1rem);

                        /* Size */
                        height: 100%;
                        width: 100%;

                        /* Display under the main content */
                        z-index: -1;
                    }
</style>
@section('content')
<body>         
   @foreach ($products->chunk(4) as $prodChunk)
        <div class="layered-card">
            @foreach ($prodChunk as $products)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                  <img src="{{ asset($products->product->product_image) }}" alt="..." class="img-responsive" width = "90px" height="90px">
                    <div class="caption">
                           <h3>{{ $products->product->description }}</h3><p>Product Price:<span>₱{{ $products->product->sell_price }}</span></p>
                      <div class="clearfix">
                      <a href="{{ route('shops.addToCart', ['id'=>$products->product_id])}}" class="btn btn-primary" role="button"><i class="fas fa-cart-plus"></i> Add to Cart</a> <a href="#" class="btn btn-default pull-right" role="button">
                      <i class="fas fa-info"></i> More Info</a>
                      </div>
                    </div>
                  </div>
                </div>
             @endforeach
         </div>
    @endforeach
</body>
@endsection
