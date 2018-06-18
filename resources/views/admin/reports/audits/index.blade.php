@extends('admin.layouts.main')

@section('title') Members Report @endsection
@section('current_reports') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Members Report <small>({{$status}})</small></h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-table"></i>Members Report ({{$status}})
                    </div>
                    <div class="widget-content padded clearfix">
                        <div class="btn-group">
                            <a href="?status=all" class="btn btn-success">All Members</a>
                            <a href="{{route('reports.members.index')}}" class="btn btn-primary">Living Members</a>
                            <a href="?status=deceased" class="btn btn-default">Deceased Members</a>
                        </div>
                        <table class="table table-striped" id="dataTable1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Marital Status</th>
                                <th>Role</th>
                                <th>Age Group</th>
                                <th>Occupation</th>
                                <th>Phones</th>
                                <th>Status</th>
                                <th></th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($members AS $key => $member)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$member->full_name}}</td>
                                    <td>{{$member->gender}}</td>
                                    <td>{{$member->marital_status_text}}</td>
                                    <td>{{$member->role->name}}</td>
                                    <td>{{$member->age_group_text}}</td>
                                    <td>{{$member->occupation}}</td>
                                    <td>{!! implode("<br>", $member->phones)  !!}</td>
                                    <td>
                                        @if($member->deceased_at)
                                            <span class="label label-danger">Deceased</span>
                                        @else
                                            <span class="label label-success">Active</span>
                                        @endif
                                    </td>

                                    <td class="actions">
                                        <div class="action-buttons">
                                            <a class="table-actions" title="View" href="{{route('families.members.show', ['id' => $member->id])}}"><i class="fa fa-eye"></i></a>
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