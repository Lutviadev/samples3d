<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Samples 3D @yield('title')</title>
        
        <!--Styles-->          
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>

        {!! HTML::style('css/app.css') !!}

        @yield('styles')         

    </head>     

    <body>

        <div class="container">                    

            @yield('content')
            
        </div>

    </body>
</html>