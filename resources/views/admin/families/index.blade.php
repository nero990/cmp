@extends('admin.layouts.main')
@section('current_families') class="current" @endsection
@section('title') Families @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>Families</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>Families
                </div>
                <div class="widget-content padded clearfix">

                    @include('errors.list')

                    <a href="{{route('families.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> New Family</a>

                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus"></i> Batch Upload
                    </button>

                    <div class="dropdown pull-right">
                        <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-cloud-download"></i>&nbsp;Export&nbsp;as&nbsp;
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="{{ route('families.exportAll', ['type' => 'csv']) }}">CSV File (*.csv)</a></li>
                            <li><a href="{{ route('families.exportAll', ['type' => 'xls']) }}">Excel 2003 File (*.xls)</a></li>
                            <li><a href="{{ route('families.exportAll', ['type' => 'xlsx']) }}">Excel 2007 File (*.xlsx)</a></li>
                        </ul>
                    </div>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                {!! Form::open(['route' => 'families.bulk-upload', 'files' => true, 'class' => 'form-horizontal']) !!}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" id="modalTitle">Batch Upload</h4>
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


                    <div class="clearfix"></div>

                    <div class="col-sm-5 pull-right">
                        {!! Form::open(['method' => 'GET', 'id' => 'searchForm', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Search</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    {!! Form::text('q', null, ['placeholder' => 'Search by registration number or family name', 'class' => "form-control" ]) !!}
                                    <div class="input-group-btn">
                                        <button class="btn btn-info">Go!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Reg. Number</th>
                            <th>Family Head</th>
                            <th>Phones</th>
                            <th class="hidden-xs">Children</th>
                            <th class="hidden-xs">Address</th>
                            <th class="hidden-xs">Card Status</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($families AS $serial => $family)
                                <tr>
                                    <td>{{ ++$serial + ($families->currentPage() - 1) * $families->perPage() }}</td>
                                    <td>{{$family->name}}</td>
                                    <td>{{$family->type_text}}</td>
                                    <td>{{$family->registration_number}}</td>
                                    <td>{{$family->head->full_name}}</td>
                                    <td>{!! implode("<br>", $family->head->phones)  !!}</td>
                                    <td class="hidden-xs text-center">{{($family->type == "1") ? $family->number_of_children : "-"}}</td>
                                    <td class="hidden-xs">{{$family->address}}</td>
                                    <td class="hidden-xs"><span class="label @if($family->card_status == "0") {{"label-danger"}} @elseif($family->card_status == "1") {{ "label-info" }} @else {{ "label-success" }} @endif">{{$family->card_status_text}}</span></td>

                                    <td class="actions">
                                        <div class="action-buttons" style="width: 120px;">
                                            <a class="table-actions" title="View" href="{{route('families.show', ['id' => $family->id])}}"><i class="fa fa-eye"></i></a>
                                            <a class="table-actions" title="Edit" href="{{route('families.edit', ['id' => $family->id])}}"><i class="fa fa-pencil"></i></a>
                                            <a class="table-actions" title="View Audit trails" href="{{route('families.audits', ['id' => $family->id])}}"><i class="fa fa-archive"></i></a>
                                            <a class="table-actions deleteFamily" title="Delete family" href="{{route('families.destroy', ['id' => $family->id])}}"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$families->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end DataTables Example -->

</div>

@endsection

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/family.js')}}" type="text/javascript"></script>
@endsection