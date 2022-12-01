@extends('layouts.base')
@section('content')
<body class="background">
<div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
  </div>     
@endif
<h3><strong>Welcome to Silicon Valley Online Store</strong></h3>
<div class="containers">
        <div class="col-md-8 col-md-offset-2">
        <h1><i class="fa fa-address-card" aria-hidden="true"></i>User Profile: {{Auth::user()->name}}</h1>
      @foreach($customers as $customer)
      <div class="avatar">
          <img class="avatar__image" src="{{ asset($customer->customer_image) }}">
          </div>
        <div class="container">
            <h3><b>First Name:</b>{{$customer->fname}}</h3>
            <h3><b>Last Name:</b>{{$customer->lname}}</h3>
            <h3><b>Phone:</b>{{$customer->phone}}</h3>
            <h3><b>Address:</b>{{$customer->address}}</h3>
            <h3><b>City:</b>{{$customer->city}}</h3>
        </div>

        <a href="{{ route('customers.edit', $customer->id) }}" class = "btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>Edit my Information</a>
        </div>

        @endforeach
</div>
</body>
@include('footer.footer_layout')
@endsection