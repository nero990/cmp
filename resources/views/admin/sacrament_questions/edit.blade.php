@extends('admin.layouts.main')

@section('title') Edit Sacrament Question @endsection
@section('current_sacrament_questions') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Edit Sacrament Question</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>Edit Sacrament Question
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>

                        {!! Form::model($sacrament_question, ['route' => ['sacrament-questions.update', $sacrament_question->id],'method' => 'PUT', 'id' => 'sacrament_question']) !!}
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Question') !!}
                                            {!! Form::text('question', null, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('status', 'Status') !!}
                                            <div class="clearfix"></div>
                                            <div class="toggle-switch switch-large" data-off="danger" data-off-label='Inactive' data-on="info" data-on-label='Active'>
                                                {!! Form::checkbox('status', '1', null, ['class' => 'form-control']); !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-warning" type="submit" value="Save">
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/sacrament_question.js')}}" type="text/javascript"></script>
@endsection