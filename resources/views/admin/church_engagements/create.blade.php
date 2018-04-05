@extends('admin.layout.main')

@section('title') Church Engagement @endsection
@section('current_church_engagements') class="current" @endsection
@section('current_church_engagements_create') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Church Engagement</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>Church Engagement
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>

                        {!! Form::open(['route' => 'church-engagements.store', 'id' => 'bccZoneForm']) !!}
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