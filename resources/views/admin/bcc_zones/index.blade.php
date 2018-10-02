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

                    @include('errors.list')

                    <a href="{{route('bcc-zones.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> New BCC Zone</a>

                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus"></i> Bulk Upload
                    </button>


                    <div class="dropdown pull-right">
                        <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-cloud-download"></i>&nbsp;Export&nbsp;as&nbsp;
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="{{ route('bcc-zones.exportAll', ['type' => 'csv']) }}">CSV File (*.csv)</a></li>
                            <li><a href="{{ route('bcc-zones.exportAll', ['type' => 'xls']) }}">Excel 2003 File (*.xls)</a></li>
                            <li><a href="{{ route('bcc-zones.exportAll', ['type' => 'xlsx']) }}">Excel 2007 File (*.xlsx)</a></li>
                        </ul>
                    </div>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                {!! Form::open(['route' => 'bcc-zones.bulk-upload', 'files' => true, 'class' => 'form-horizontal']) !!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="modalTitle">Bulk Upload</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <small><strong>File Header: </strong>{{$required_fields}}</small>
                                        <a href="#" id="downloadCsv" data-content="{{$required_fields}}">Download sample file</a>
                                    </div>
                                    <div class="form-group">
                                        {{Form::file('excel_file')}}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    {!! Form::submit('Upload', ['class' => 'btn btn-info']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th class="hidden-xs">Streets</th>
                                <th class="hidden-xs">Date Added</th>
                                <th class="hidden-xs">Status</th>
                                <th width="12%"></th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($bcc_zones AS $serial => $bcc_zone)
                                <tr>
                                    <td>{{ (++$serial + ($bcc_zones->currentPage() - 1) * $bcc_zones->perPage()) }}</td>
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
                        {{$bcc_zones->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end DataTables Example -->

</div>

@endsection