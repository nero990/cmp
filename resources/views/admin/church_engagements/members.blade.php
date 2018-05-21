@extends('admin.layout.main')

@section('title') Church Engagements  @endsection
@section('current_church_engagements') class="current" @endsection
@section('current_church_engagements_index') class="current" @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>{{$church_engagement->name}} Members</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>{{$church_engagement->name}} Members
                </div>
                <div class="widget-content padded clearfix">

                    <button class="btn btn-success" id="" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus"></i> Add New Member
                    </button>

                    <a href="{{route('church-engagements.index')}}" class="btn btn-info">&laquo; Back</a>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                {!! Form::open(['route' => ['church-engagements.members.store', 'church_engagement' => $church_engagement->id], 'id' => 'churchEngagementMembers', 'class' => 'form-horizontal']) !!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="modalTitle">New Church Engagement</h4>
                                </div>

                                <div class="modal-body">

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}

                                        <div class="col-sm-10">

                                            {!! Form::text('q', '', ['placeholder' => 'Search member', 'class' => "form-control", "id" => 'q' ]) !!}
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>

                        </div>
                    </div>


                    <table class="table table-striped" id="dataTable1">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="20%">Phone Number</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>Occupation</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($members AS $k => $member)
                            <tr>
                                <td>{{$k + 1}}</td>
                                <td>{{$member->full_name}}</td>
                                <td>{{$member->email}}</td>
                                <td>
                                    {!! implode("<br>", $member->phones) !!}
                                </td>
                                <td>{{$member->gender}}</td>
                                <td>{{$member->marital_status}}</td>
                                <td>{{$member->occupation}}</td>
                                <td class="actions">
                                    <div class="action-buttons" style="width: 100%">
                                        <a class="table-actions" title="View Audit trail" href="{{route('families.members.show', ['id' => $member->id])}}"><i class="fa fa-eye"></i></a>
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