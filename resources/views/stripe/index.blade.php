@extends('layouts.app')

@section('template_title')
    Showing Plans
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               All Plans
                            </span>

                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th class="hidden-xs">storage</th>
                                    <th class="hidden-xs">photos</th>
                                    <th class="hidden-xs">price</th>
                                    <th>Actions</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="users_table">
                                @foreach($plans as $plan)
                                    <tr>
                                        <td>{{$plan->id}}</td>
                                        <td>{{$plan->name}}</td>
                                        <td>{{$plan->storage}}</td>
                                        <td>{{$plan->photos}}</td>
                                        <td>{{$plan->price}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'plans/' . $plan->id, 'class' => '',
                                            'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>
                                            <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs
                                            hidden-sm hidden-md"> Plan</span>', array('class' => 'btn btn-danger
                                            btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('users/' . $plan->id) }}" data-toggle="tooltip" title="Show">
                                                <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span
                                                        class="hidden-xs hidden-sm">Show</span><span class="hidden-xs
                                                         hidden-sm hidden-md"> Plan</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('users/' . $plan->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span
                                                        class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs
                                                         hidden-sm hidden-md"> Plan</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    {{--
        @include('scripts.tooltips')
    --}}

    {{-- @if(config('laravelusers.enableSearchUsers')) --}}
    @include('scripts.search-users')
    {{-- @endif --}}

@endsection
