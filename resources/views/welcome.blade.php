<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        -->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/c2cc5ff5ba.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="logo">
                    <img src="{{ URL::to('/') }}/img/ahma-logo.png" alt="AHMA learn" />
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
        <div class="language">
            {{__('localization.select_language')}}:
            <a href="/lang/en">EN</a>
            <a href="/lang/kr">KR</a>
        </div>
        <div class="welcome">
            <div class="container">
                <div class="content">
                    <!--span class="welcomeText">{{__('localization.welcome')}}</span-->
                    <h1>{!!__('localization.web_title')!!}<br/></h1>
                    <span class="subtitleText">{!!__('localization.web_subtitle')!!}</span>
                    <!--span class="subtitleSpecial">{{__('localization.web_subtitle_special')}}</span--><br/>
                    <a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a> 
                </div>
            </div>
        </div>

        <div class="courses">
            <div class="container">
                <span>Welcome to AHMAlearn</span>
                <h2>Our amazing courses</h2>
                <p>
                    Choose from our thoughtfully crafted lectires,<br/> which offer a comparable corriculum and pace as highly reputed schools.
                </p>
                <div class="row">
                    <div class="courseList">
                        <div class="item">
                            <div class="courseBox">
                                <div class="icon">
                                    <img src="{{ URL::to('/') }}/img/lang/south-korea.svg" />
                                </div>
                                <h3>Learn Korean (EN)</h3>
                                <p>This curriculum is instructed in english.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s

                                </p>
                                <a href="{{ route('login') }}" class="button">Read more</a>
                                <!--a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a-->
                            </div>
                            <div class="courseBox">
                                <div class="icon">
                                    <img src="{{ URL::to('/') }}/img/lang/united-kingdom.svg" />
                                </div>
                                <h3>Learn English (KR)</h3>
                                <p>This curriculum is instructed in korean.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s

                                </p>
                                <a href="{{ route('login') }}" class="button">Read more</a>
                                <!--a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a-->
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="centerCta">
            <div class="container">
                <div class="ctaPanel">
                    <h2>What are you waiting for?</h2>
                    <p>Signup or login and start your new learning journey</p>
                    <a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a> 
                </div>
            </div>
        </div>
        
        <div class="steps">
            <div class="container">

                <div class="text">
                    <h2>How it all works</h2>
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
                <div class="image">
                    <img src="{{ URL::to('/') }}/img/app.png" />
                </div>
            </div>
        </div>


    </body>
</html>
