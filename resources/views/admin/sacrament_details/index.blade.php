@extends('admin.layout.main')

@section('title') Sacrament Details @endsection
@section('current_bcc_zones_index') class="current" @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>Sacrament Details</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>Sacrament Details List
                </div>
                <div class="widget-content padded clearfix">
                    <a href="{{route('sacrament-details.create')}}" class="btn btn-warning"><span class="fa fa-plus"></span> New Sacrament Detail</a>

                    <table class="table table-bordered table-striped" id="dataTable1">
                        <thead>
                            <th class="check-header hidden-xs">
                                <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                            </th>
                            <th>Question</th>
                            <th>Response Type</th>
                            <th class="hidden-xs">Date Added</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($sacrament_details AS $sacrament_detail)
                            <tr>
                                <td class="check hidden-xs">
                                    <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                                </td>
                                <td>{{$sacrament_detail->question}}</td>
                                <td>{{$sacrament_detail->response_type_value}}</td>
                                <td class="hidden-xs">{{$sacrament_detail->created_at->toFormattedDateString()}}</td>
                                <td class="actions">
                                    <div class="action-buttons">
                                        <a class="table-actions" title="View Audit trail" href="{{route('sacrament-details.edit', ['id' => $sacrament_detail->id])}}"><i class="fa fa-eye"></i></a>
                                        <a class="table-actions" title="Edit" href="{{route('sacrament-details.edit', ['id' => $sacrament_detail->id])}}"><i class="fa fa-pencil"></i></a>
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