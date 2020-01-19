<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: linear-gradient(315deg, #00bfa5 0%, #a7ffeb 30%);
                background-attachment: fixed;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"><img src="{{ Auth::user()->avatar }}" width="50px" style="margin-left:1%;border-radius:30px;"></a>
                    @else
                        <a href="{{ url('auth/google') }}"><img src="google2.png" width="150"></a>
                        <iframe id="logoutframe" src="https://accounts.google.com/logout" style="display:none"></iframe>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <p style="background-color:#00bfa5;color:#a7ffeb;">Incidencias Plaiaundi</p>
                    <img src="incidencia.png" width="200" height="200">
                </div>
            </div>
        </div>
    </body>
</html>
