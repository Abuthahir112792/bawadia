<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">var APP_URL = {!! json_encode(url('/')) !!};</script>
    
    @yield('css')
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href="{{ asset('fronts/css/bootstrap.css')}}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('fronts/css/animate.css')}}" type='text/css' media='all' />
		<link rel='stylesheet' href="{{ asset('fronts/css/icon-fonts.css')}}" type='text/css' media='all'/>
		<link rel='stylesheet' href="{{ asset('fronts/css/main.css')}}" type='text/css' media='all'/>
		<link rel='stylesheet' href="{{ asset('fronts/css/responsive.css')}}" type='text/css' media='all' />
    <link rel="shortcut icon" href="{{ asset('fronts/images/favicon.png')}}">
@yield('loader')

@yield('header')

@yield('content')


@yield('footer')

<!-- javascript -->
@yield('slider')

    <script type='text/javascript' src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
		<script type='text/javascript' src="{{ asset('fronts/js/jquery.js')}}"></script>
		<script type='text/javascript' src="{{ asset('fronts/js/plugins.js')}}"></script>
		<script type='text/javascript' src="{{ asset('fronts/js/jquery.main.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
@yield('javascript')

</html>
