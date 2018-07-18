@extends('admin.layouts.main')

@section('title') BCC Zones @endsection
@section('current_bcc_zones') class="current" @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>BCC Zones</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>BCC Zones List
                </div>
                <div class="widget-content padded clearfix">
                    <a href="{{route('bcc-zones.create')}}" class="btn btn-warning"><span class="fa fa-plus"></span> New BCC Zone</a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable1">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th class="hidden-xs">Streets</th>
                                <th class="hidden-xs">Date Added</th>
                                <th class="hidden-xs">Status</th>
                                <th width="12%"></th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($bcc_zones AS $bcc_zone)
                                <tr>
                                    <td>{{$bcc_zone->name}}</td>
                                    <td>{{$bcc_zone->address}}</td>
                                    <td class="hidden-xs">
                                        <ul>
                                            @foreach($bcc_zone->streets as $street)
                                                <li>{{$street}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="hidden-xs">{{$bcc_zone->created_at->toFormattedDateString()}}</td>
                                    <td class="hidden-xs">
                                        @if($bcc_zone->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="actions">
                                        <div class="action-buttons" style="width: 100%">
                                            <a class="table-actions" title="View" href="{{route('bcc-zones.show', ['id' => $bcc_zone->id])}}"><i class="fa fa-eye"></i></a>
                                            <a class="table-actions" title="Edit" href="{{route('bcc-zones.edit', ['id' => $bcc_zone->id])}}"><i class="fa fa-pencil"></i></a>
                                            <a class="table-actions" title="View Audit trail" href="{{route('bcc-zones.audits', ['id' => $bcc_zone->id])}}"><i class="fa fa-archive"></i></a>
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
    </div>
    <!-- end DataTables Example -->

</div>

@endsection