<!doctype html>
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
                background-color: #1DA1F2;
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
                    @if(auth()->check())
                    
                    @if(auth()->user()->role_id == 1)
                        <a href="{{ route('admin.index') }}" style="color: white">Home</a>
                    @elseif(auth()->user()->role_id == 2)
                        <a href="{{ route('dean.index') }}" style="color: white">Home</a>
                    @elseif(auth()->user()->role_id == 3)
                        <a href="{{ route('head.index') }}" style="color: white">Home</a>
                    @elseif(auth()->user()->role_id == 4)
                        <a href="{{ route('member.index') }}" style="color: white">Home</a>
                    @endif
                    @endif
                    @else
                        <a href="{{ route('login') }}" style="color: white">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="color: white">
                   Faculty Monitoring of Arts and Letters
                </div>

            </div>
        </div>
    </body>
</html>




