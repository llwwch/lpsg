<!DOCTYPE html>
<html>
<head>
   <title>laravel</title>
   <link href="{{ asset('assets/bower/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
   <script src="{{ asset('assets/bower/jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ asset('assets/bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</head>
<body>
   @section('sidebar')
            This is the master sidebar.
        @show
   <div class="continer">
      <div class="row">
         <div class="col-md-2">asdf</div>
         <div class="col-md-7">
            @yield('content')
         </div>
      </div>
         <div class="col-md-3">asdf</div>
      
   </div>
</body>
</html>