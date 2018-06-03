@extends('admin.layout.main')

@section('title') New Sacrament Question @endsection
@section('current_sacrament_questions') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>New Sacrament Question</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>New Sacrament Question
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>

                        {!! Form::open(['route' => 'sacrament-questions.store', 'id' => 'bccZoneForm']) !!}
                            @include('admin.sacrament_questions.partials.form')
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