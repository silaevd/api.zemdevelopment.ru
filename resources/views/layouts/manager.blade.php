<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Meta information -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Кабинет</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
{{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link rel="stylesheet" href="{{ asset('js/libs/fileuploader/jquery.fileuploader-theme-thumbnails.css') }}">
        <link rel="stylesheet" href="{{ asset('js/libs/fileuploader/jquery.fileuploader.min.css') }}">

        <link href="{{ asset('css/manager.css') }}" rel="stylesheet">
    </head>

    <body>

        <div class="wrapper">

            <nav class="nav-extended white">
                <div class="nav-wrapper">
                    <a href="{{ url('/manager') }}" class="brand-logo">Manager</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a class="btn-floating btn waves-effect waves-light orange tooltipped" data-position="bottom" data-tooltip="Вернуться на сайт">
                                <i class="material-icons">desktop_windows</i>
                            </a>
                        </li>
                        <li>
                            <a class="btn-floating btn waves-effect waves-light orange tooltipped" data-position="bottom" data-tooltip="Выйти">
                                <i class="material-icons">exit_to_app</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main">
                @yield('content')
            </div>

        </div>


        <!-- Compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <script src="{{ asset('js/libs/fileuploader/jquery.fileuploader.js') }}"></script>
        <script src="{{ asset('js/fileuploader/project.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>

    </body>

</html>