<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style-auth.css') }}">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 offset-4">
                <div class="right-column text-center">
                    <img src="{{ asset('images/ShareZone.png') }}" alt="" class="logo" width="200">
                    <p class="info">Sign in to see photos and videos form your friends.</p>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group my-2">
                           <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email"   value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                        </div>
                        <div class="form-group my-2">
                           <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block px-5 text-dark">Log in</button>
                       </form>
                       <p class="or">OR</p>
                        <a href="#" class="text-dark fw-bold text-decoration-none"><img src="{{ asset('images/Facebook-logo.png') }}" class="fb-logo" width="50"> Sign In with Facebook</a>
                        <p><a href="#" class="my-3 text-dark text-decoration-none">forget password?</a></p>
                    </div>
                <div class="right-column2">
                    <p class="">Don't you have an account? <a href="{{ route('register') }}" class="text-decoration-none text-info fw-bold">Sign Up</a></p>
                </div>
        </div>
    </div>
</body>
</html>

