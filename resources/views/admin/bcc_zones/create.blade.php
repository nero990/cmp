@extends('admin.layouts.main')

@section('title') New BCC Zones @endsection
@section('current_bcc_zones_create') class="current" @endsection

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

                        <div id="message"></div>

                        {!! Form::open(['route' => 'bcc-zones.store', 'id' => 'bccZoneForm']) !!}
                            @include('admin.bcc_zones.partials.form')
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