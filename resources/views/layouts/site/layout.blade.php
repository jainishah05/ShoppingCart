<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('https://unpkg.com/flickity@2/dist/flickity.min.css') }}"> --}}
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" type="image/png" href="{{ asset(get_config('favicon')) }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->
<body>
  {{-- Stripe payment method --}}
  <script src="{{ asset('https://js.stripe.com/v3/') }}"></script>
  @yield('content')
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js') }}"></script>
  {{-- validation --}}
  <script src="{{ asset('js/jquery.validate.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/additional-methods.js') }}"></script>
  <script src="{{ asset('https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js') }}"></script>
  {{-- <script src="{{ asset('https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js') }}"></script>  --}}
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
  <script src="{{ asset('js/price-range.js') }}"></script>
  <script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/validation.js') }}"></script>
  <script>
    $(document).ready(function(){
      $('.slider').bxSlider();
    });
  </script>
</body>
</html>