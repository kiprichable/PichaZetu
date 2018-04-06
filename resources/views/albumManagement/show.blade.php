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
        <div class="page-header">
            <a href={{URL::asset('albums')}}>&laquo; Back to Albums</a>
            <a class="pull-right glyphicon-plus" href={{URL::asset('albums/'.$album['id'].'/edit')}} > Edit
                Album</a>
        </div>
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