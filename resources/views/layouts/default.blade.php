<html>
    <head>
        <title>Heribertslab.dev | @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        @include('layouts.topnav')

        @section('sidebar')
        @show

        <div class="container">
            @yield('content')
        </div>

        <!-- Footer js libs and scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        @yield('scripts')
    </body>
</html>
