@extends('layouts.base')
@section('title')
    Your Cart
@endsection 
@section('content')
    @if(Session::has('cart'))

    @error('cart')
     <small>{{ $message }}</small>
   @enderror
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($product as $product)
                            <li class="list-group-item">
                    <span class="badge">{{ $product['qty'] }}</span>
                        <strong>{{ $product['product']['description'] }}</strong>
                    <span class="label label-success">{{ $product['product']['sell_price'] }}</span>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('shop.reduceByOne',['id'=>$product['product']['id']]) }}">Reduce By 1</a></li>
                                        <li><a href="{{ route('shop.remove',['id'=>$product['product']['id']]) }}">Reduce All</a></li>

                                    </ul>
                                </div>
                                
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total:₱ {{ $totalPrice }}.00</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('shop.checkout') }}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>No Items yet</h2>
            </div>
        </div>
    @endif
@include('footer.footer_layout')
@endsection