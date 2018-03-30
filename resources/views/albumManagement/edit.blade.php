@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
        .nopad {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        /*image gallery*/
        .image-checkbox {
            cursor: pointer;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        .image-checkbox input[type="checkbox"] {
            display: none;
        }

        .image-checkbox-checked {
            border-color: #b0131d;
        }
        .image-checkbox .fa {
            position: absolute;
            color: #a30915;
            background-color: #fff;
            padding: 0%;
            top: 0;
            right: 0;
        }
        .image-checkbox-checked .fa {
            display: block !important;
        }
    </style>
    <div class="container">
        <div class="page-header">
            <a href={{URL::asset('albums/'.$album['id'])}}>&laquo; Back to Album</a>
        </div>
        <div class="centered-form">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    {{Form::open(['url' => 'albums/'.$album['id'], 'method' => 'DELETE'])}}
                    <button class="btn-danger pull-right">Delete Album</button>
                    {{Form::close()}}
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$album['name']}} <small>Edit/Delete and/or upload more
                                photos!</small></h3>
                    </div>
                    <div class="panel-body">
                        {{Form::open(['url' => 'albums/'.$album['id'], 'method' => 'PATCH', 'files' =>  'true'])}}
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" value="{{$album['name']}}" class="form-control  input-sm" placeholder="Album Name">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="description" value="{{$album['description']}}" id="description" class="form-control  input-sm" placeholder="Album description">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="file" name="photos[]" id="photos" class="form-control input-sm"
                                   placeholder="Upload photos" multiple>
                        </div>
                        <div class="tz-gallery">

                            <div class="row">

                                @foreach($album->photos()->get() as $photo)
                                    <div class="col-lg-6 nopad text-center">
                                        <label class="image-checkbox">
                                            <img class="image-responsive lightbox" src="{{URL::Asset('/')
                                            .$photo->watermarked.'/'
                                            .$photo->name}}" alt="watermarked" height="200" height="200">
                                           <input type="checkbox" name="image[]" value="{!! $photo->id !!}" />
                                            <i class="fa fa-check hidden" style="margin-right: 15%"></i>
                                        </label>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <input type="submit" value="Submit" class="btn btn-info btn-block">

                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // image gallery
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }
            else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked",!$checkbox.prop("checked"))

            e.preventDefault();
        });
    </script>
@stop