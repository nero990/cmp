@extends('admin.layouts.main')

@section('title') New Member @endsection
@section('current_families') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>New Member</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>New Member
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>
                        @include('errors.list')

                        {!! Form::open(['route' => ['families.members.store', 'family' => $family->id], 'id' => '']) !!}
                        @include('admin.members.partials.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/members.js')}}" type="text/javascript"></script>
@endsection