<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('chatify-meta')
    <title>ShareZone</title>

    @stack('chatify-head')
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/comment.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZO/fFDbepSS3COgJ61hCR5zZfDf1Pr/6cvxZWPF0dwTyjJO1z3iLcItv5mgyCQYUS12gNlDzqjwE28nqEG1rWg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">


</head>
<body class="{{ $body_class ?? ''}}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mt-3"  id="nav-col">
            <div class="container">
                <a class="navbar-brand d-flex"  href="{{ route('posts.index') }}">
                    <div><img src="{{ asset('images/ShareZone.png') }}" class="pr-3" alt="cclogo" style="height:50px; border-right: 1px solid #ffffff"> </div>
                    <b><div class="pl-3" style="font-family: 'Segoe Script';color: #ffffff;  font-size: x-large ; margin: 0px;  padding: 0px" >ShareZone</div></b>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <b><a id="auth-nav" style="color: #ffffff;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></b>
                            </li>
                            <li  class="pt-1" style="color:white">
                               <b style="font-size: large">|</b>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                   <b> <a id="auth-nav" style="color: #ffffff;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></b>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a style="color: #ffffff ; " id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b> {{ Auth::user()->name }}</b> <span class="caret"></span>
                                </a>

                                <div style="background-color: rgba(102, 244, 242, 0.9)" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a style="color: #ffffff;" class="dropdown-item" href="#">
                                      <b><p class="pl-3" style="color: #ffffff; margin: 0px;  padding: 0px" > Profile</p></b>
                                    </a>

                                    <a style="color: #ffffff" class="dropdown-item" href="{{ route('chatify') }}">
                                        <b><p class="pl-3" style="color: #ffffff;  margin: 0px; padding: 0px" >Chatify</p></b>
                                    </a>

                                    <a style="color: #ffffff" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <b>  <p class="pl-3" style="color: #ffffff; margin: 0px; padding: 0px" >{{ __('Logout') }}</p></b>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </nav>



 <!-- afficher les erreurs-->
 @if($errors->any())
 <div class="alert alert-danger my-3">
     <ul>
         @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif
@if (session('status'))
    <div class="alert alert-success my-3">
         {{ session('status') }}
    </div>
 @endif

        <main class="py-4">
            @yield('content')
        </main>
        </div>
@stack('chatify-footer')
<script src="{{ asset('js/unfollow.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/comment.js') }}"></script>
<script src="{{ asset('js/addfriend.js') }}"></script>
<script src="{{ asset('js/likes.js') }}"></script>
</body>


</html>

