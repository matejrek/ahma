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
        <div class="welcome">
            <div class="container">
                <div class="text">
                    <h1>Start your learning journey today!</h1>
                    <p>Structured and prepared so you can learn even with a tight schedule.</p>
                    <a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a>
                </div>
            </div>
        </div>

        <div class="courses">
            <div class="container">
                <span>Welcome to AHMAlearn</span>
                <h2>Our featured courses</h2>
                <p>
                    Choose from our thoughtfully crafted courses,<br/> which offer a comparable corriculum and pace as school corriculums.
                </p>
                <div class="row">
                    <div class="courseList">
                        @foreach($lessons as $item)
                            <div class="item">
                                <div class="courseBox">
                                    <div class="learn">
                                        <img src="{{ URL::to('/') }}/img/lang/south-korea.svg" />
                                    </div>
                                    <div class="lang">
                                        <img src="{{ URL::to('/') }}/img/lang/united-kingdom.svg" />
                                    </div>
                                    <h3>{{$item->name}}</h3>
                                    <p>This curriculum is in english.
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s

                                    </p>
                                    <a href="{{ route('login') }}" class="button">Enroll</a>
                                    <!--a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a-->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
             </div>
        </div>

        <!--div class="startCta">
            <div class="container">
                <span>Start learning:</span> <a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a>
            </div>
        </div-->

        <div class="steps">
            <div class="container">
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
                    <p>On set days, you will receive an email with instructions and tasks on new topics for you to learn. Or login to our web application on follow the course there!</p>
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
        <div class="startCta">
            <div class="container">
                <span>What are you waiting for? - Start now</span> 
                <a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a>
            </div>
        </div>
        <div class="cta">
            <div class="container">
                <h2>What are you waiting for? - Sign up now</h2>
                <a href="{{ route('login') }}" class="button">Login</a> <a href="{{ route('register') }}" class="button secondary">Register</a>
            </div>
        </div>


        <div class="footer">
            <a href="#">Instagram</a>
        </div>
    </body>
</html>
