<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('tampilan-sikepeg/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    .input-group .btn {
        border-left: none; /* Menghilangkan border kiri tombol */
        border-radius: 0 .25rem .25rem 0; /* Membulatkan sisi kanan */
    }
    .form-control {
        border-radius: .25rem 0 0 .25rem; /* Membulatkan sisi kiri */
    }
    .form-control:focus, .btn:focus {
        box-shadow: none; /* Menghilangkan bayangan fokus */
    }
    .btn i {
        color: #6c757d; /* Menyesuaikan warna ikon */
    }
</style>
</head>

<body>
    <div class="login-clean">
        <form action="{{ route('admin.login_handler') }}" method="post">
            @csrf
            <div class="illustration">
                <img src="{{ asset('image/logo.svg') }}" alt="Logo">
            </div>

            @if (session()->get('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('fail') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h1 class="text-center">Login Sebagai Admin</h1>
            <br><br>

            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Masukkan Username Anda"
                    value="{{ old('username') }}">
                @error('username')
                    <div class="text-center d-block text-danger mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
    <div class="input-group">
        <input class="form-control" type="password" name="password" placeholder="Password" value="{{ old('password') }}" id="password">
        <div class="input-group-append">
            <button class="btn btn-light border" type="button" id="showPasswordBtn">
                <i class="fas fa-eye-slash"></i>
            </button>
        </div>
    </div>
    @error('password')
    <div class="text-center d-block text-danger mt-1">
        {{ $message }}
    </div>
    @enderror
</div>


            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Log In</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showPasswordBtn').click(function() {
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
    </script>

</body>

</html>
