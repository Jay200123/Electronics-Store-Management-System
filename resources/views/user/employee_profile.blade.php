@extends('layouts.employee_base')
@section('content')
<style>
  .avatar{
    border-radius: 50%;
    height: 160px;
    width: 150px;
  }

  .avatar-image{
    border-radius: 50%;
    height: 100%;
    width: 100%;
  }

  .containers{
    right: 0;
    position: fixed;
    top: 50%;
    transform: translate(0px, -50%);
  }

  .background{
    background-image: linear-gradient(to left, #66ccff, #0066ff);
  }
</style>

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
<div class="containers">
        <div class="col-md-8 col-md-offset-2">
        <h1><i class="fa fa-address-card" aria-hidden="true"></i>User Profile: {{Auth::user()->name}}</h1>
      @foreach($employees as $employee)
      <div class="avatar">
        <img class="avatar-image" src="{{asset($employee->employee_image)}}">
      </div>
      <div class="container">
            <h3><b>First Name:</b>{{$employee->fname}}</h3>
            <h3><b>Last Name:</b>{{$employee->lname}}</h3>
            <h3><b>Phone:</b>{{$employee->phone}}</h3>
            <h3><b>Address:</b>{{$employee->address}}</h3>
            <h3><b>City:</b>{{$employee->city}}</h3>
        </div>

        <a href="{{ route('employees.edit', $employee->id) }}" class = "btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>Edit my Information</a>
        </div>
        @endforeach
</div>
</body>
@include('footer.footer_layout')
@endsection