<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AHMAlearn</title>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/c2cc5ff5ba.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            body {
                /*font-family: 'Nunito';*/
                font-family: 'Nunito Sans', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="language">
            {{__('localization.select_language')}}:
            <a href="/lang/en">EN</a>
            <a href="/lang/kr">KR</a>
        </div>
        <div class="header">
            <div class="container">
                <div class="logo">
                    <img src="{{ URL::to('/') }}/img/ahma-logo-3.png" alt="AHMA learn" />
                </div>
                @if (Route::has('login'))
                    <div class="authBar">
                        @auth
                            <a href="{{ url('/courses') }}" class="link">Courses</a>
                        @else
                            <a href="{{ route('login') }}" class="link">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="link">Register</a>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="welcome">
            <div class="heroBoard">
                <div class="container">
                <div class="content">
                    <h1>Start learning<br/> a new language</h1>
                    <span>Extend your opportunities by learning <b>Korean</b><br/>
                        or if you already know korean, then learn <b>English</b>
                    </span>
                    <div class="buttons">
                    <a href="{{ route('register') }}" class="button">Register</a> <a href="{{ route('login') }}" class="button secondary">Login</a>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="courses">
            <div class="container">
                <span>Welcome to AHMAlearn</span>
                <h2>Our lessons are amazing</h2>
                <p>
                    Choose from our thoughtfully crafted lectures,<br/> which offer a even higher level at a better pace as highly reputed schools.
                </p>
                <div class="courseList">
                    <div class="courseBox kr">
                        <span>Corriculum in English</span>
                        <h3>Korean lessons</h3>
                        <p>Lorem ipsum dolor sit amet</p>
                        <a href="{{ route('login') }}" class="button">Read more</a>
                        <div class="icon">
                            <img src="{{ URL::to('/') }}/img/lang/south-korea.svg" />
                        </div>
                    </div>
                    <div class="courseBox en">
                        <span>Corriculum in Korean</span>
                        <div class="icon">
                            <img src="{{ URL::to('/') }}/img/lang/united-kingdom.svg" />
                        </div>
                        <h3>English lessons</h3>
                        <p>Lorem ipsum dolor sit amet</p>
                        <a href="{{ route('login') }}" class="button">Read more</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="superTop">
            <div class="container">
                <div class="content">
                    <h2>What are you waiting for?</h2>
                    <span>Start your learning journey now</span>
                    <a href="{{ route('register') }}" class="button">Register</a> <a href="{{ route('login') }}" class="button secondary">Login</a>
                </div>
            </div>
        </div>

        <div class="steps">
            <div class="container">
                <h2>How it all works</h2>
                <div class="links">
                    <a class="button terciary" href="/faq">FAQ</a>
                    <a class="button terciary" href="/about/korean-lessons">Korean lessons</a>
                    <a class="button terciary" href="/about/english-lessons">English lessons</a>
                </div>
                <div class="stepList">
                    <div class="step one">
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3>Signup and enroll</h3>
                        <p>Signup for an account and enroll to one or multiple courses - all for free!</p>
                    </div>

                    <div class="step two">
                        <div class="icon">
                            <i class="fab fa-readme"></i>
                        </div>
                        <h3>Follow your curriculum</h3>
                        <p>On set days, you will new lectures with instructions and tasks on new topics for you to learn. Or login to our web application on follow the course there!</p>
                    </div>

                    <div class="step three">
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Need more guidance?</h3>
                        <p>Subscribe to a course to enhance your learning journey. With a active sunscription you will get access to extended exercises, even more detailed explanations and examples, so you can climb the ladder of success with ease!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="superBottom">
            <div class="container">
                <div class="content">
                    <h2>Go and start learning now!</h2>
                    <span>The best <b>Korean</b> and <b>English</b> lessons are waiting for you</span>
                    <a href="{{ route('register') }}" class="button">Register</a> <a href="{{ route('login') }}" class="button secondary">Login</a>
                </div>
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
        <div class="cookiesNotice">
            <div class="container">
                AHMAlearn is using cookies <span id="cookiesPreferences" class="cookieButton">Preferences</span>
            </div>
        </div>
    </body>
</html>
