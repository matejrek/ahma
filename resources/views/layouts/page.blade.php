<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <!-- Bootstrap -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c2cc5ff5ba.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <div class="courseDashboard">
            <div class="dashHeader">
                <div class="container">
                    <div class="logo">
                        <a href="/courses">
                        <img src="{{ URL::to('/') }}/img/ahma-logo-3.png" alt="AHMA learn" />
                        </a>
                    </div>

                    <div class="menuBar">
                        <a href="{{ url('/courses') }}" class="link">Courses</a>
                        <a href="/billing" class="link">Billing</a>
                        <a href="/user/profile" class="link">{{ __('Profile') }}</a>
                    </div>
                </div>
            </div>
            <div class="container">

                @yield('content')

            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="column">
                    <h4>AHMA</h4>
                    <ul>
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Contact us</a>
                        </li>
                        <li>
                            <a href="#">English lessons</a>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <h4>Products</h4>
                    <ul>
                        <li>
                            <a href="#">Korean lessons</a>
                        </li>
                        <li>
                            <a href="#">English lessons</a>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <h4>Discover</h4>
                    <ul>
                        <li>
                            <a href="#">Developer blog</a>
                        </li>
                        <li>
                            <a href="#">News</a>
                        </li>
                        <li>
                            <a href="#">Instagram</a>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <h4>Support</h4>
                    <ul>
                        <li>
                            <a href="#">Customer support</a>
                        </li>
                        <li>
                            <a href="#">Feature request</a>
                        </li>
                        <li>
                            <a href="#">Billing</a>
                        </li>
                    </ul>
                </div>
                <div class="notation">
                    ©{{ now()->year }} AHMAlearn 
                </div>
            </div>
        </footer>



    </div>

    @yield('scripts')
</body>
    
</html>
