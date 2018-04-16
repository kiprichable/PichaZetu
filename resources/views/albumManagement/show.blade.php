@extends('layouts.app')
@section('content')
    @if(Session::has('Success'))
        <div class="alert alert-success" role="alert">
            <strong>{{Session::get('Success')}} </strong>
        </div>
    @endif
    @if(Session::has('Error'))
        <div class="alert alert-danger" role="alert">
            <strong> {{Session::get('Error')}} </strong>
        </div>
    @endif
    <div class="container gallery-container">
        @if(Auth::User())
        <div class="page-header">
            <a href={{URL::asset('albums')}}>&laquo; Back to Albums</a>
            <a class="pull-right glyphicon-plus" href={{URL::asset('albums/'.$album['id'].'/edit')}} > Edit
                Album</a>
        </div>
        @endif
        <section class="gallery">
            <div class="container clearfix">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-lg-8">
                                <h2 class="heading">{{$album['name']}}</h2>
                                <p class="lead">Gallery: <small>{{$album['description']}}</small></p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($album->photos()->get() as $photo)
                                <div class="col-sm-4">
                                    <h6>${{ $photo['id'] }}</h6>
                                    <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{ $photo['id'] }}">
                                        <input type="hidden" name="name" value="{{ $photo['name'] }}">
                                        <input type="hidden" name="price" value="{{ $photo['id'] }}">
                                        <input type="hidden" name="url" value="{{ URL::Asset('/').$photo->watermarked.'/'.$photo->name }}">
                                        <button class="btn btn-success pull-left" style="margin-bottom: 2%;
                                        margin-right: 1%"><i class="glyphicon glyphicon-shopping-cart"></i>Add
                                            to cart</button>
                                    </form>

                                    <form action="{{ url('/wishlist') }}" method="POST" class="side-by-side">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="id" value="{{ $photo['id'] }}">
                                        <input type="hidden" name="name" value="{{ $photo['name'] }}">
                                        <input type="hidden" name="price" value="{{ $photo['id'] }}">
                                        <input type="hidden" name="url" value="{{ URL::Asset('/').$photo->watermarked.'/'.$photo->name }}">
                                        <button class="btn btn-danger" style="margin-bottom: 2%"><i
                                                    class="glyphicon glyphicon glyphicon-heart"></i></button>
                                    </form>
                                    <div class="box">
                                        <a href="{{URL::Asset('/').$photo->watermarked.'/'.$photo->name}}" title=""
                                           data-toggle="lightbox" data-gallery="portfolio" data-title="{!!
                                           $album['description']. ' '. $photo['id']!!}"
                                           data-footer="{!!$album['description'] !!}">
                                            <img src="{{URL::Asset('/').$photo->watermarked.'/'.$photo->name}}" alt="" class="img-responsive">
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}

@stop