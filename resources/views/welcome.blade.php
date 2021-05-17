<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-left {
                position: relative;
                right: 10px;
                top: 18px;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .nav.navbar-nav.navbar-right li a {
                color: white;
            }
        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

    <nav class="navbar navbar-inverse" style="background-color: #3490dc">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand active" href="{{ url('/') }}" style="color: white">
                    {{ config('app.name', 'Knowledge-Bank') }}
                </a>
            </div>
            @if (Route::has('login'))
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        @auth
                            <li><a href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>

                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span>Register</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
            @endif
        </div>
    </nav>

        <div class="">

                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="center-block" src="https://www.callcentrehelper.com/images/stories/2020/03/laptop-turns-into-book-760.jpg" width="760" height="440" alt="IMAGE">
                        </div>

                        <div class="item">
                            <img class="center-block" src="https://www.kpsol.com/wp-content/uploads/2019/06/KPSOL-glossary-one.jpg" width="760" height="440" alt="IMAGE">
                        </div>

                        <div class="item">
                            <img class="center-block" src="https://static.helpjuice.com/helpjuice_production/uploads/upload/image/4752/direct/1597678311691-Explicit%20Knowledge.jpg" width="760" height="440" alt="IMAGE">
                        </div>

                        <div class="item">
                            <img class="center-block" src="https://greenlogic.pl/wp-content/uploads/2018/01/0003_transfer-learning.jpg" width="760" height="440" alt="IMAGE">
                        </div>

                        <div class="item">
                            <img class="center-block" src="https://www.englishacademyitalia.com/wp-content/uploads/2017/04/Many-people-chatting-about-everything-learning.jpg" width="760" height="440" alt="IMAGE">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

        </div>
        <footer style="width: 100%; text-align: center; font-weight: 700; position: fixed; left: 0; bottom: 0;">
            <p>Copyright © 2021 All Rights Reserved by <a href="http://www.viyellatexgroup.com/" target="_blank">VIYELLATEX GROUP</a></p>
        </footer>
    </body>
</html>
