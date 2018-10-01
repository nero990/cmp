@extends('admin.layouts.main')

@section('title') Uploaded Files @endsection
@section('current_uploaded_files') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Uploaded Files</h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-table"></i>Uploaded Files
                    </div>
                    <div class="widget-content padded clearfix">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th class="text-center">Record Count</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($uploaded_files AS $serial => $uploaded_file)
                                    <tr>
                                        <td>{{ (++$serial + ($uploaded_files->currentPage() - 1) * $uploaded_files->perPage()) }}</td>
                                        <td>{{$uploaded_file->name}}</td>
                                        <td>{{$uploaded_file->type}}</td>
                                        <td>{{$uploaded_file->status}}</td>
                                        <td class="text-center">{{ $uploaded_file->type == 'FAMILY' ? $uploaded_file->families_count : $uploaded_file->bcc_zones_count}}</td>
                                        <td>{{$uploaded_file->created_at->toFormattedDateString()}}</td>
                                        <td>{{$uploaded_file->updated_at->toFormattedDateString()}}</td>
                                        <td class="actions">
                                            <div class="action-buttons">
                                                <a class="table-actions" title="View Records" href="{{route('uploaded-files.show', ['id' => $uploaded_file->id])}}"><i class="fa fa-eye"></i></a>
                                                <a class="table-actions" title="View Uploade Report" href="{{route('uploaded-files.report', ['id' => $uploaded_file->id])}}"><i class="fa fa-archive"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$uploaded_files->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end DataTables Example -->

    </div>

@endsection