@extends('admin.layouts.main')

@section('title') Settings @endsection
@section('current_settings') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Settings</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>Settings
                    </div>
                    <div class="widget-content padded">

                        @include('errors.list')

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($settings AS $setting)
                                    <tr>
                                        <td>{{$setting['description']}}</td>
                                        <td>{{$setting['value']}}</td>
                                        <td>
                                            <a href="{{route('settings.edit', $setting['id'])}}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
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
    </div>

@endsection