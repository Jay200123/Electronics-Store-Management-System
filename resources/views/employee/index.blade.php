@extends('layouts.admin_base')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }

  .color{
    background: linear-gradient(to bottom, #ffcc99 0%, #ffff00 100%);
  }
</style>
<body class="color">

<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
 
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Image</td>
          <td>Name</td>
          <td>Email</td>
          <td>Role</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($employee as $employees)
        <tr>
            <td>{{$employees->user->id}}</td>
            <td><img src="{{asset($employees->employee_image) }}" height="80px" width="80px"></td>
            <td>{{$employees->user->name}}</td>
            <td>{{$employees->user->email}}</td>
            <td>{{$employees->user->role}}</td>

            <td class="text-center">
            <a href="{{ route('roles.edit', $employees->user->id)}}" class = "btn btn-primary btn-sm">Edit</a>
            <form method="post" action="{{ route('employees.destroy', $employees->id) }}">
              @csrf
              <input type="hidden" name="_method" value="DELETE" />
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
</body>
@endsection