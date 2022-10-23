<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<nav class="navbar navbar-default" style="background-color:#ffff00">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">

  <li>
  <form class="navbar-form navbar-left" method="GET" role="search" action="{{url('/search')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
  <input type="text" name="search" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
  </form>
  </li>
    <li>
    <a href="{{route('getProducts')}}">
    <i class="fa fa-mobile" aria-hidden="true"></i>Products
    </a>
    </li>

    <li> 
    <a href="{{ route('getEmployees') }}">
    <i class="fa-solid fa-users" aria-hidden="true"></i> Employee
    </a>
    </li>

    <li>
    <a href="{{route('getCustomers')}}">
    <i class="fa fa-user" aria-hidden="true"></i>Customer
    </a>
    </li>


          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if (Auth::check())
              <li><i class="fa fa-user" aria-hidden="true"><a href="{{ route('employee.profile') }}"></i>Employee Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><i class="fa fa-sign-out" aria-hidden="true"><a href="{{ route('user.logout') }}"></i>Logout</a></li>
              @else
              <li><i class="fa fa-user-plus" aria-hidden="true"><a href="{{ route('user.signup') }}"></i>Customer Signup</a></li>
              <li><i class="fa fa-user-plus" aria-hidden="true"><a href="{{ route('user.employee') }}"></i>Employee Signup</a></li>
              <li><i class="fa fa-sign-in" aria-hidden="true"><a href="{{ route('user.signin') }}"></i>Signin</a></li>
            @endif
          </ul>
        </li>
    </ul>
</div>
</div> 
</nav>      


