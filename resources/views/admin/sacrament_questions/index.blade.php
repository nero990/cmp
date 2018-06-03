@extends('admin.layout.main')

@section('title') Sacrament Questions @endsection
@section('current_sacrament_questions') class="current" @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>Sacrament Questions</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>Sacrament Questions List
                </div>
                <div class="widget-content padded clearfix">

                    @include('errors.list')

                    <button class="btn btn-warning" id="newEngagement" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus"></i> New Sacrament Question
                    </button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                {!! Form::open(['route' => 'sacrament-questions.store', 'id' => 'bccZoneForm']) !!}

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="modalTitle">New Church Engagement</h4>
                                </div>

                                <div class="modal-body">

                                    <div class="form-group">
                                        {!! Form::label('name', 'Question') !!}
                                        {!! Form::text('question', null, ['class' => 'form-control']) !!}
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    {!! Form::submit('Save', ['class' => 'btn btn-info']) !!}
                                </div>
                                {!! Form::close() !!}

                            </div>

                        </div>
                    </div>

                    <table class="table table-bordered table-striped" id="dataTable1">
                        <thead>
                            <th class="check-header hidden-xs">
                                <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                            </th>
                            <th>Question</th>
                            <th>Status</th>
                            <th class="hidden-xs">Date Added</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($sacrament_questions AS $sacrament_question)
                            <tr>
                                <td class="check hidden-xs">
                                    <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                                </td>
                                <td>{{$sacrament_question->question}}</td>
                                <td><span class="label label-{{$sacrament_question->is_enabled ? "success" : "danger"}}">{{$sacrament_question->status}}</span></td>
                                <td class="hidden-xs">{{$sacrament_question->created_at->toFormattedDateString()}}</td>
                                <td class="actions">
                                    <div class="action-buttons">
                                        <a class="table-actions" title="View Audit trail" href="{{route('sacrament-questions.edit', ['id' => $sacrament_question->id])}}"><i class="fa fa-eye"></i></a>
                                        <a class="table-actions" title="Edit" href="{{route('sacrament-questions.edit', ['id' => $sacrament_question->id])}}"><i class="fa fa-pencil"></i></a>
                                        <a class="table-actions" href=""><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end DataTables Example -->

</div>

@endsection