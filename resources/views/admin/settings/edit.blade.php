@extends('admin.layouts.main')

@section('title') Edit Settings @endsection
@section('current_settings') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Settings</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>Edit Settings
                    </div>
                    <div class="widget-content padded">

                        <div class="col-md-6">
                            @include('errors.list')

                            {!! Form::open(['method' => 'PUT', 'route' => ['settings.update', $setting['id']],'class'=>'form-horizontal']) !!}

                            <div class="form-group">
                                {!! Form::label($setting['description'], $setting['description'], ['class' => 'control-label']) !!}


                                {!! Form::text('value', $setting['value'], ['placeholder' => 'John Smith', 'class' => "form-control", "id" => 'name' ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection