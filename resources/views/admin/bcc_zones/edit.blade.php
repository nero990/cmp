@extends('admin.layouts.main')

@section('title') {{$bcc_zone->name}} Zone @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>BCC Zone Management</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>{{$bcc_zone->name}} Zone
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>

                        {!! Form::model($bcc_zone, ['route' => ['bcc-zones.update', $bcc_zone->id],'method' => 'PUT', 'id' => 'bccZoneForm']) !!}
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