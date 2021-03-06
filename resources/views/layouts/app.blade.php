<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Knowledge-Bank') }}</title>

    <!-- Favicon Start -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('public/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Favicon End -->

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!--Select2 Start-->
    <script src="{{ asset('public/select2/jquery.min.js') }}"></script>
    <script src="{{ asset('public/select2/select2.min.js') }}"></script>
    <link href="{{ asset('public/select2/select2.min.css') }}" rel="stylesheet"/>
    <!--Select2 End-->

    <!--Loader Start-->
    <style>
        .loader {
            border: 20px solid #f3f3f3;
            border-radius: 50%;
            border-top: 20px solid #3498db;
            width: 35px;
            height: 35px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <!--Loader End-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #76ad0e">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h3>{{ config('app.name', 'Knowledge-Bank') }}</h3>
                </a>
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
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user"></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <nav class="navbar navbar-expand-lg navbar-dark">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                        <ul class="navbar-nav">
                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{ url('/home') }}">Home <span class="sr-only">(current)</span></a>
                                            </li>
                                            @if(Auth::user()->status == 1)

                                            @if(Auth::user()->access_level == 0)

                                            <li class="nav-item dropdown active">
                                                <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    Users @if(isset($new_requests_count) && ($new_requests_count > 0)) <span class="badge badge-danger ml-1">{{ $new_requests_count }}</span> @endif
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                                                    <a class="dropdown-item" href="{{ url('/users') }}">User List</a>
                                                    <a class="dropdown-item" href="{{ url('/new_account_requests') }}">New Requests @if(isset($new_requests_count) && ($new_requests_count > 0)) <span class="badge badge-danger ml-1">{{ $new_requests_count }}</span> @endif </a>
                                                </div>
                                            </li>

                                            <li class="nav-item dropdown active">
                                                <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    Config
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">
                                                    <a class="dropdown-item" href="{{ url('/applicability_list') }}">Applicability</a>
                                                    <a class="dropdown-item" href="{{ url('/category_list') }}">Category</a>
                                                    <a class="dropdown-item" href="{{ url('/document_type_list') }}">Document Type</a>
                                                    <a class="dropdown-item" href="{{ url('/departments') }}">Department</a>
                                                </div>
                                            </li>
                                            @endif

                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{ url('/documents') }}">Documents</a>
                                            </li>
                                            @endif
                                            <li class="nav-item dropdown active">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer style="width: 100%; text-align: center; font-weight: 500; left: 0; bottom: 0;">
        <p>Copyright ?? 2021 All Rights Reserved by <a href="http://www.viyellatexgroup.com/" target="_blank">VIYELLATEX GROUP</a></p>
    </footer>
</body>
</html>
