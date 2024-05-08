
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style-auth.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-4">
            <div class="right-column text-center">
                <img src="{{ asset('images/ShareZone.png') }}" alt="" class="logo" width="170">
                <p class="info">Sign un to see photos and videos form your friends.</p>
                <button class="btn btn-primary btn-bold"><img src="{{ asset('images/google-logo.png') }}" class="fb-logo" width="50"> Sign In with Google</button>
                <p class="or">OR</p>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group my-2">
                       <input type="email" class="form-control" placeholder="Email adress " name="email">
                    </div>
                    <div class="form-group my-2">
                       <input type="text" class="form-control" placeholder="Username" name="name">
                    </div>
                    <div class="form-group my-2">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                     </div>
                     <div class="form-group my-2">
                        <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation">
                     </div>
                         <button type="submit" class="btn btn-primary btn-block px-5">Sign Up</button>
                   </form>
                   <p class="terms">By signing up , you agree to our <b>Terms, Data Policy</b> and  <b>Cookies Policy</b>.</p>
            </div>
            <div class="right-column-login text-center">
                <p>Have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login</a></p>
            </div>
    </div>
</div>
</body>
</html>
