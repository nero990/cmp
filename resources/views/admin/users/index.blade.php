@extends('admin.layouts.main')

@section('title') Users @endsection
@section('current_users') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Admin Users</h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-table"></i>Users
                    </div>
                    <div class="widget-content padded clearfix">

                        @include('errors.list')

                        <button class="btn btn-warning" id="newEngagement" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus"></i> New Admin User
                        </button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    {!! Form::open(['route' => 'users.store', 'id' => 'user', 'class' => 'form-horizontal']) !!}
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" id="modalTitle">New Admin User</h4>
                                    </div>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}

                                            <div class="col-sm-9">
                                                {!! Form::text('name', null, ['placeholder' => 'Full Name', 'class' => "form-control" ]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}

                                            <div class="col-sm-9">
                                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => "form-control" ]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}

                                            <div class="col-sm-9">
                                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => "form-control" ]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-3 control-label']) !!}

                                            <div class="col-sm-9">
                                                {!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => "form-control" ]) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        {!! Form::submit('Create User', ['class' => 'btn btn-info']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                            </div>
                        </div>


                        <table class="table table-striped" id="dataTable1">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Last logged in</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users AS $user)
                                <tr>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->person->name}}</td>
                                    <td>{{$user->last_logged_in}}</td>
                                    <td>{{$user->created_at->format('d-M-Y')}}</td>
                                    <td>{{$user->updated_at->format('d-M-Y')}}</td>
                                    <td class="actions">
                                        <div class="action-buttons">
                                            <a class="table-actions" title="View Audit trail" href=""><i class="fa fa-eye"></i></a>
                                            <a class="table-actions" title="Edit" href="#"><i class="fa fa-pencil"></i></a>
                                            <a class="table-actions" href=""><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end DataTables Example -->

    </div>

@endsection