<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'User Listing')}}</title>

        <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

        <script src="https://kit.fontawesome.com/8ba1cbb372.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/app.js')}}"></script>
    </head>
    <body>
        <header id="mainheader">
            <h1>User Listing</h1>
        </header>
        @yield('content')
        <footer id="mainfooter">
            <div class="copyright">
                Copyright User Listing App
            </div>
        </footer>
    </body>
</html>
