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
                    <a href="{{route('church-engagements.create')}}" class="btn btn-warning"><span class="fa fa-plus"></span> New Church Engagement</a>

                    <table class="table table-bordered table-striped" id="dataTable1">
                        <thead>
                            <th class="check-header hidden-xs">
                                <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                            </th>
                            <th>Name</th>
                            <th>Members Count</th>
                            <th>Date Added</th>
                            <th></th>
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
                                    <div class="action-buttons">
                                        <a class="table-actions" title="View Audit trail" href="{{route('church-engagements.edit', ['id' => $church_engagement->id])}}"><i class="fa fa-eye"></i></a>
                                        <a class="table-actions" title="Edit" href="{{route('church-engagements.edit', ['id' => $church_engagement->id])}}"><i class="fa fa-pencil"></i></a>
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