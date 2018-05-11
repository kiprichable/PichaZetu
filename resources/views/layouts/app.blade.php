<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if (!Auth::guest() && Auth::user()->level() >= 4)
    <title>{{ Auth::user()->name }}</title>
    @else
        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
    @endif
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap and Font Awesome css-->
    <!-- we use cdn but you can also include local files located in css directory-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Google fonts - Montserrat for headings, Cardo for copy-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700|Cardo:400,400italic,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{URL::Asset('css/style.css')}}" id="theme-stylesheet">
    @yield('template_linked_fonts')

    {{-- Styles --}}
    <link href="{{ URL::Asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::Asset('css/style.css')}}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{URL::Asset('css/ekko-lightbox.css')}}">
    @yield('template_linked_css')
    <!-- ekko lightbox-->
    <!-- Custom stylesheet - for your changes-->
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{URL::Asset('img/logo.png')}}">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body data-spy="scroll" data-target="#navigation">
<!-- intro-->
<!-- intro end-->
<!-- navbar-->
@include('partials.header')
<div id="app">
    <div class="container">
        @include('partials.form-status')
    </div>
    @yield('content')

</div>
<!-- jQuery-->
@include('partials.footer')
</body>
</html>
