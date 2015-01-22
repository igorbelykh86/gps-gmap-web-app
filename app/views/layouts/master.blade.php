<!DOCTYPE html>
<html>
    <head>
        <title>{{ $page_title }}</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Custom css -->
        <link rel="stylesheet" href="{{ URL::to('css/custom.css') }}">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <!-- Google Maps -->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCkOSnEeTrtFH8tfyuRkSoPGaOPJWhJMdg&sensor=FALSE"></script>
        <!-- Custom script -->
        <script src="{{ URL::to('js/main.js') }}"></script>
    </body>
</html>