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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdn.tiny.cloud/1/626ohkakcw8r5gtwmm2ct9296u1cq1tzq0r95c3ba2l8tzts/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>


</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="mysidebar card">
                        <ul class="menu">
                            <li class="item">
                                <a class="link" href="/">Home</a>
                            </li>
                            <li class="item">
                                <a class="link" href="/admin">Dashboard</a>
                            </li>
                            <li class="item">
                                <a class="link" href="/admin">Lessons</a>
                            </li>
                            <li class="item">
                                <a class="link" href="/admin/lesson/create">Create new lesson</a>
                            </li>
                            <li class="item">
                                <a class="link" href="/admin/lesson/type/create">Create new lesson type</a>
                            </li>
                            <li class="item">
                                <br/><br/><br/>
                                <a class="link" href="/admin/send">Send mails manually</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <main class="mainContent card">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>


    @yield('scripts')
</body>
    
</html>
