@extends('admin.layouts.main')

@section('title') {{$uploaded_file->name}} @endsection
@section('current_uploaded_files') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>{{$uploaded_file->name}}</h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-table"></i>{{$uploaded_file->name}}
                    </div>
                    <div class="widget-content padded clearfix">


                        <div class="col-sm-5">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Uploaded File Name</th>
                                        <td>{{$uploaded_file->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{$uploaded_file->type}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{$uploaded_file->status}}</td>
                                    </tr>
                                    <tr>
                                        <th>Success Count</th>
                                        <td>{{$uploaded_file->details->success_count}}</td>
                                    </tr>
                                    <tr>
                                        <th>Failure Coung</th>
                                        <td>{{$uploaded_file->details->error_count}}</td>
                                    </tr>
                                </table>
                            </div>

                            @if($uploaded_file->details->success_count > 0)
                            <a href="{{route('uploaded-files.show', ['id' => $uploaded_file->id])}}" class="btn btn-success-outline">
                                <i class="fa fa-eye"></i> View Records
                            </a>
                            @endif

                        </div>

                        @if($uploaded_file->details->errors)
                        <div class="col-sm-7">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Entity Name</th>
                                        <th>Error Message</th>
                                    </tr>
                                    @foreach($uploaded_file->details->errors as $error)
                                        <tr>
                                            <td><code>{{json_encode($error->entity)}}</code></td>
                                            <td><pre>{{json_encode($error->error_message)}}</pre></td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        @endif


                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end DataTables Example -->

    </div>

@endsection