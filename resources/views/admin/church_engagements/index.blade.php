@extends('admin.layout.main')

@section('title') Church Engagements  @endsection
@section('current_church_engagements') class="current" @endsection
@section('current_church_engagements_index') class="current" @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>Church Engagements</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>Church Engagements List
                </div>
                <div class="widget-content padded clearfix">
                    @include('errors.list')

                    <button class="btn btn-warning" id="newEngagement" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus"></i> New Church Engagement
                    </button>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                {!! Form::open(['route' => 'church-engagements.store', 'id' => 'churchEngagement', 'class' => 'form-horizontal']) !!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="modalTitle">New Church Engagement</h4>
                                </div>

                                <div class="modal-body">

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}

                                        <div class="col-sm-10">
                                            {!! Form::text('name', null, ['placeholder' => 'Name of Church Engagement', 'class' => "form-control", "id" => 'name' ]) !!}
                                        </div>
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
                            <th>Name</th>
                            <th>Members Count</th>
                            <th>Date Added</th>
                            <th width="12%"></th>
                        </thead>
                        <tbody>
                        @foreach($church_engagements AS $church_engagement)
                            <tr>
                                <td class="check hidden-xs">
                                    <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                                </td>
                                <td>{{$church_engagement->name}}</td>
                                <td>{{$church_engagement->members_count}}</td>
                                <td>{{$church_engagement->created_at->toFormattedDateString()}}</td>
                                <td class="actions">
                                    <div class="action-buttons" style="width: 100%">
                                        <a class="table-actions" title="View Members" href="{{route('church-engagements.members', ['id' => $church_engagement->id])}}"><i class="fa fa-users"></i></a>
                                        <a class="table-actions" title="View Audit trail" href="{{route('church-engagements.members', ['id' => $church_engagement->id])}}"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="table-actions edit-engagement" data-target="#myModal" data-toggle="modal" data-value='{!! $church_engagement !!}' title="Edit"><i class="fa fa-pencil"></i></a>
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

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/church-engagement.js')}}" type="text/javascript"></script>
@endsection