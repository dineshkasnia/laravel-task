<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="{{asset('css/style.css')}}" rel="stylesheet"></link>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand {{Route::currentRouteName() == 'home' ? 'active' : ''}}" href="{{route('home')}}">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
        </li> -->
        <li class="nav-item"><a class="nav-link {{Route::currentRouteName() == 'genre' ? 'active' : ''}}" href="{{route('genre')}}">Genre</a></li>
        <li class="nav-item"><a class="nav-link {{Route::currentRouteName() == 'artist' ? 'active' : ''}}" href="{{route('artist')}}">Artist</a></li>
        <li class="nav-item"><a class="nav-link {{Route::currentRouteName() == 'venue' ? 'active' : ''}}" href="{{route('venue')}}">Venue</a></li>
        <li class="nav-item"><a class="nav-link {{Route::currentRouteName() == 'events' ? 'active' : ''}}" href="{{route('events')}}">Events</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Logout</a></li>     
      </ul>
      @if(Route::currentRouteName() == 'events')
        <div class="d-flex my-search">
          <input class="form-control me-5 search-input" maxlength="50" type="text" placeholder="Enter 3 characters of event title to search (50 maxlength)">
        </div>
      @endif
    </div>
  </div>
</nav>
<div class="search"></div>

@if (session('error'))
    <div class="container mt-3">
      <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible fade show danger-alert" role="alert">
            {{ session('error') }}
        </div>
    </div>
    </div>
@endif

@if (session('success'))
    <div class="container mt-3">
      <div class="col-sm-12">
        <div class="alert alert-success alert-dismissible fade show danger-alert" role="alert">
            {{ session('success') }}
        </div>
    </div>
    </div>
@endif

@if (session('warning'))
    <div class="container mt-3">
      <div class="col-sm-12">
        <div class="alert alert-warning alert-dismissible fade show danger-alert" role="alert">
            {{ session('warning') }}
        </div>
    </div>
    </div>
@endif

  @yield('content')
    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>
    
    <script type="text/javascript">
      
    </script>
  </body>
</html>