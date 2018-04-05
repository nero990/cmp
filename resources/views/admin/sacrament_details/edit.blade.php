@extends('admin.layout.main')

@section('title') {{$sacrament_detail->question}} @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>{{$sacrament_detail->question}} Zone</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>{{$sacrament_detail->question}}
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>

                        {!! Form::model($sacrament_detail, ['route' => ['sacrament-details.update', $sacrament_detail->id],'method' => 'PUT', 'id' => 'bccZoneForm']) !!}
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