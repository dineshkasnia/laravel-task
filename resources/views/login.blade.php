<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="{{asset('css/style.css')}}" rel="stylesheet"></link>
    </head>
    <body>
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
        <div class="box">
            <form method="post" action="{{route('login.post')}}">
                @csrf
                <center><h3>LOGIN</h3></center>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email" name="email" class="form-control" />
                    @foreach($errors->get('email') as $email)
                      <div class="alert alert-danger danger-alert" role="alert">
                        {{$email}}
                      </div>
                    @endforeach
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" name="password" class="form-control" />  
                    @foreach($errors->get('password') as $password)
                      <div class="alert alert-danger danger-alert" role="alert">
                        {{$password}}
                      </div>
                    @endforeach
                </div>
                <center><button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button></center>
            </form>
        </div>
        <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>