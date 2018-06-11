@extends('admin.layouts.main')

@section('title') Edit Member @endsection
@section('current_families') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Edit Member</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>{{  $member->full_name }}
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>
                        @include('errors.list')

                        {!! Form::model($member, ['route' => ['families.members.update', 'member' => $member->id], 'method' => 'PUT', 'id' => '', 'class' => ($disabled) ? 'disabledForm' : '']) !!}
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