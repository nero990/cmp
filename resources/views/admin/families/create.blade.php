@extends('admin.layout.main')

@section('title') New Family @endsection
@section('current_families') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>New Family</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>New Family
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>
                        @include('errors.list')

                        {!! Form::open(['route' => 'families.store', 'id' => 'familyForm']) !!}
                            @include('admin.families.partials.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/family.js')}}" type="text/javascript"></script>
@endsection