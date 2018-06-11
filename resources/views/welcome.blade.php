<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            
            h1{
                font-size: 60px;
                text-align: left;
                margin-top: 40px;
                font-family: 'Cerebri Sans', Arial, sans-serif;
                font-weight: 700
            }
            img {
                max-width: 100%;
                height: auto;
            }
        </style>
        

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel m-0 p-0">
                <div class="container nav-container">
                    <a class="navbar-brand" href="{{ url('/') }}"> 
                        <img class="logo-dark" alt="ICEF" src="http://www.ic.etf.bg.ac.rs/wp-content/uploads/2018/03/icef_logo_transparent_1-light-1.png">
                        <img class="logo-light" alt="ICEF" src="http://www.ic.etf.bg.ac.rs/wp-content/uploads/2018/03/icef_logo_transparent_1.png">	 
                    </a>
        
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="content my-4">
            <div class="row">
                <div class="col-sm-6 p-5">
                    <h1>Web Application for Recording Studies and Patient Data</h1>
                </div>
                <div class="col-sm-6">
                    <img src="/images/doctor-using-a-digital-tablet.jpg" alt="">
                </div>
            </div>
        </div>
        
        @include('layouts.partials._footer')

    </body>
</html>
