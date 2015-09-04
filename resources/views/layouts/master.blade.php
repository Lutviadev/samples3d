<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">

        <title>Samples 3D @yield('title')</title>

        <!--Styles-->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel='stylesheet' type='text/css'>

        {!! HTML::style('css/app.css') !!}

        @yield('styles')

        <!--JQuery-->
        {!! HTML::script('http://code.jquery.com/jquery-latest.min.js') !!}

    </head>

    <body>

        @include('layouts.partials.flashmessage')

        @include('layouts.partials.header')

        <div id="viewport">

            @include('layouts.partials.menu')

            <div id="content" class="right-side">

                @yield('page-header')
                @yield('content')

            </div>

        </div>

        <!--Scripts-->
        {!! HTML::script('js/all.js') !!}

        @yield('scripts')

    </body>
</html>