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

                    <table class="table table-bordered table-striped" id="dataTable1">
                        <thead>
                            <th class="check-header hidden-xs">
                                <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                            </th>
                            <th>Name</th>
                            <th>Address</th>
                            <th class="hidden-xs">Streets</th>
                            <th class="hidden-xs">Date Added</th>
                            <th class="hidden-xs">Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($bcc_zones AS $bcc_zone)
                            <tr>
                                <td class="check hidden-xs">
                                    <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                                </td>
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
                                    <div class="action-buttons">
                                        <a class="table-actions" title="View Audit trail" href="{{route('bcc-zones.show', ['id' => $bcc_zone->id])}}"><i class="fa fa-eye"></i></a>
                                        <a class="table-actions" title="Edit" href="{{route('bcc-zones.edit', ['id' => $bcc_zone->id])}}"><i class="fa fa-pencil"></i></a>
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