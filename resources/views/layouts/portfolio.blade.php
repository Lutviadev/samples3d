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

        {!! HTML::style('css/owl.carousel.css') !!}
        {!! HTML::style('css/portfolio.css') !!}

        @yield('styles')         
        
        <!--JQuery--> 
        {!! HTML::script('http://code.jquery.com/jquery-latest.min.js') !!}

    </head>     

    <body>
    
        @yield('content')
        
        <!--Scripts--> 
        {!! HTML::script('js/owl.carousel.min.js') !!} 

        @yield('scripts') 

    </body>
</html>