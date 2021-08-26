<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>@yield('message')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/geral.css') }}" rel="stylesheet">

        <style>

            body {
                margin: 1em;
            } 

            img {
                margin-top: 70px;
                width: 70%;
            }

        </style>
    </head>
    <body>
        <div class="tag-spacing">
            <h1 class="descripttio_title_custom">OOPS...</h1>
        </div>
        <div class="position-forgot">
            <h3 class="descripttio_title_custom">@yield('message')</h3>
        </div>
        <div class="position-yORn">
            <a class="btn-back btn_include btn-more-space" href="{{ app('router')->has('home') ? route('home') : url('/') }}">Voltar</a>
        </div>
        <div class="position-yORn">
            <img src="/img/geral/tela_erro_Prancheta_1.png" alt="">
        </div>
    </body>
</html>
