@extends('layouts.gallery')
@section('content')
<div class="container gallery-container">

    <h1>Name of Album Or Client</h1>

    <p class="page-description text-center">Description</p>

    <div class="tz-gallery">

        <div class="row">
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-12 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="{{URL::Asset('img/1.jpg')}}">
                    <img src="{{URL::Asset('img/1.jpg')}}" alt="Park">
                </a>
            </div>
        </div>

    </div>

</div>
@stop

