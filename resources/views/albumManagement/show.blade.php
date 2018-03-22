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
            <h1>{{$album['name']}}</h1>

            <p class="page-description text-center">{{$album['description']}}</p>

            <div class="tz-gallery">

                <div class="row">
                    @foreach($album->photos()->get() as $photo)
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="{{URL::Asset('/').$photo->watermarked.'/'.$photo->name}}">
                            <img src="{{URL::Asset('/').$photo->watermarked.'/'.$photo->name}}" alt="watermarked">
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>

        </div>
@stop