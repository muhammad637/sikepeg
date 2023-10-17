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
        <form action="{{ route('pegawai.login_handler') }}" method="post">
            @csrf
            <div class="illustration">
                <img src="{{ asset('image/logo.svg') }}" alt="">
            </div>
            @if (session()->get('fail'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('fail') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row justify-content-center gap-2">
                
                <a href="{{ route('admin.login') }}" class="col-md-5 col-sm-12 btn btn-success">
                    Login Sebagai Admin
                </a>
                <a href="{{ route('pegawai.login') }}" class="col-md-5 col-sm-12 btn btn-secondary">
                    Login Sebagai Pegawai
                </a>

            </div>
            
            <br>
            <br>

           
            {{-- <form class="user" method="post"> --}}
                <div class="form-group">
                    <input class="form-control" type="text" name="nip_nippk" placeholder="Masukan NIP/NIPPK Anda"
                        value="{{ old('nip_nippk') }}">
                </div>
                @error('nip_nippk')
                <div class="text-center d-block text-danger" style="margin-top:-15px">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password"
                        value="{{ old('password') }}">
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

</body>

</html>