<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Picha Sell</title>
    <!-- Overrides and Custom Styles -->
    <link rel="stylesheet" href="{{ URL::Asset('css/app.css') }}">
    <link rel='stylesheet prefetch' href='//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

    <![endif]-->
</head>

@include('partials.header')
@include('partials.nav')
@include('partials.content')
@include('partials.footer')

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='{{URL::Asset('js/gallery.js')}}'></script>
</body>
</html>