
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('tampilan-sikepeg/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
    <div class="login-clean">
        <form action="{{ route('admin.login_handler') }}" method="post">
             @csrf
                <div class="illustration">
                <img src="{{ asset('image/logo.svg') }}" alt="">
            </div>
            @if (session()->get('fail'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('fail') }}
                <button type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            <div class="row justify-content-center gap-2">
                
                <a href="#" class="col-md-5 col-sm-12 btn btn-success">
                    Login Sebagai Admin
                </a>
                <a href="{{ route('pegawai.login') }}" class="col-md-5 col-sm-12 btn btn-secondary">
                    Login Sebagai Pegawai
                </a>

            </div>
            
            <br>
            <br>
            
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Masukan Username Anda"  value="{{ old('username') }}">
            </div>
            @error('username')
            <div class="text-center d-block text-danger" style="margin-top:-15px">
                {{ $message }}
            </div>
             @enderror
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password" value="{{ old('password') }}" id="password">
                <div class="input-group-append m-2">
                    <button class="btn btn-outline-secondary d-none" type="button" id="showPassword">Show</button>
                  </div>
            </div>
            @error('password')
            <div class=" text-center d-block text-danger" style="margin-top:-15px;">
                {{ $message }}
            </div>
        @enderror
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button>
            </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#showPassword").click(function(){
            var passwordField = $("#password");
            var passwordFieldType = passwordField.attr('type');
            
            // Toggle between 'password' and 'text'
            passwordField.attr('type', passwordFieldType === 'password' ? 'text' : 'password');
          });
        });
      </script>
</body>
</html>

{{-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div class=" row justify-content-center gap-2">
        <div class="col-md-5 p-5 bg-success">1</div>
        <div class="col-md-5 p-5 bg-warning">2</div>
        <a href="" class="col-md-6 mx-2" style="font-family: Nunito; padding: 10px; font-size: 20px; text-decoration:none; color: white;">Login Sebagai Admin</a>
        <a href="" class="col-md-4" style="font-family:  Nunito;  padding: 10px; font-size: 20px; text-decoration:none;  color: white;">Login Sebagai Pegawai</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html> --}}