@extends('admin.layout.main')

@section('title') New BCC Zones @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>New BCC Zone</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>New BCC Zone
                    </div>
                    <div class="widget-content padded">
                        {!! Form::open(['route' => 'bcc-zones.store', 'id' => 'bccZoneForm']) !!}
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Name') !!}
                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('address', 'Address') !!}
                                            {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '4']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('status', 'Status') !!}
                                            <div class="clearfix"></div>
                                            <div class="toggle-switch switch-large" data-off="danger" data-off-label='Inactive' data-on="info" data-on-label='Active'>
                                                {!! Form::checkbox('status', '1', true, ['class' => 'form-control']); !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="streets">Streets</label>
                                            <button type="button" class="btn btn-default btn-xs" onclick="duplicate()"><i class="fa fa-plus-circle"></i> Add More</button>
                                            <button type="button" class="btn btn-outline-danger btn-xs" onclick="remove()"><i class="fa fa-minus-circle"></i> Remove</button>
                                            <div>
                                                {!! Form::text('streets[]', null, ['class' => 'form-control', 'id' => 'origin', 'style' => 'margin-bottom: 5px']) !!}

                                            </div>

                                            <div class="btn-group">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-warning" type="submit" value="Create New BCC Zone">
                            </fieldset>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/bcc-zone.js')}}" type="text/javascript"></script>
@endsection