@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="centered-form">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create a new album <small>and upload photos!</small></h3>
                    </div>
                    <div class="panel-body">
                       {{Form::open(['url' => 'albums', 'method' => 'POST', 'files' =>  'true'])}}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" value="{{ old('name') }}" id="name"
                                               class="form-control input-sm" placeholder="Album Name">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="description" value="{{ old('description') }}"
                                               id="description" class="form-control  input-sm" placeholder="Album description">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="file" name="photos[]" id="photos" class="form-control input-sm"
                                       placeholder="Upload photos" multiple>
                            </div>

                            <input type="submit" value="Create Album" class="btn btn-info btn-block">

                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop