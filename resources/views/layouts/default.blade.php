<html>
    <head>
        <title>Heribertslab.dev | @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/select2/4.0.3/css/select2.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/fontawesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
        @yield('styles')
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
        <script src="https://cdn.jsdelivr.net/select2/4.0.3/js/select2.full.min.js" type="text/javascript"></script>
        @include('layouts.vuejs')
        @yield('scripts')
    </body>
</html>
