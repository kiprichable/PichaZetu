@extends('layouts.app1')
@section('content')
<div id="slide-window">

    <ol id="slides" start="1">

        <li class="slide color-0 alive" style="background-image:url({{URL::Asset('img/1.jpg')}})"></li>

        <li class="slide color-1" style="background-image:url({{URL::Asset('img/1.jpg')}})"></li>

        <li class="slide color-2" style="background-image:url({{URL::Asset('img/1.jpg')}})"></li>

        <li class="slide color-3" style="background-image:url({{URL::Asset('img/1.jpg')}})"></li>

        <li class="slide color-4" style="background-image:url({{URL::Asset('img/1.jpg')}})"></li>

    </ol>
    <div class="album">
        {{--This name will be the photographers name--}}
        Daniel Photograpy
        {{--This link will be either for photographers Gallery or clients pictures--}}
        <a href="#">Visit Gallery</a>
    </div>
    <span class="nav-slide fa fa-chevron-left fa-3x" id="left"></span>
    <span class="nav-slide fa fa-chevron-right fa-3x" id="right"></span>
</div>
@stop