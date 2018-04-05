@extends('admin.layout.main')

@section('title') New Sacrament Detail @endsection
@section('current_sacrament_details') class="current" @endsection
@section('current_sacrament_details_create') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>New Sacrament Detail</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>New Sacrament Detail
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>

                        {!! Form::open(['route' => 'sacrament-details.store', 'id' => 'bccZoneForm']) !!}
                            @include('admin.sacrament_details.partials.form')
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