<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@inject('home', 'App\Http\Controllers\HomeController')
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
    
    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(!empty($home->favicon()) )
        <link rel="shortcut icon" href="{{{ asset($home->favicon()->value) }}}">
    @else
        <link rel="shortcut icon" sizes="196x196" href="{{ asset('images/settings/favicon.ico') }}">
    @endif

    <title>Slim Responsive Bootstrap 4 Admin Template</title>

    <!-- vendor css -->

   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
   <body class="dashboard-5">
    <div id="app">
      <!-- MAIN -->
      @yield('content')
    </div>
    <script src="{{url('js/lan.js')}}"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyCuWEQWfVkWfcUoSIZeGw5JioT9LVCwYkE"></script>
    <script src="../lib/gmaps/js/gmaps.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

  </body>
  {{-- <script>
    // rename myToken as you like
    window.myToken =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
    </script> --}}
</html>
  