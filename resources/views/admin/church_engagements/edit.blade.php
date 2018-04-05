@extends('admin.layout.main')

@section('title') New BCC Zones @endsection
@section('current_church-engagement') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>{{$church_engagement->name}} Zone</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>{{$church_engagement->name}} Zone
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>

                        {!! Form::model($church_engagement, ['route' => ['church-engagements.update', $church_engagement->id],'method' => 'PUT', 'id' => 'bccZoneForm']) !!}
                            @include('admin.church_engagements.partials.form')
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