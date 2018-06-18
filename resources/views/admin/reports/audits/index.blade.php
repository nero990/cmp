@extends('admin.layouts.main')

@section('title') Audit Trail @endsection
@section('current_reports') class="current" @endsection
@section('current_reports_audits') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Audit Trail</h1>
        </div>
        <!-- DataTables Example -->
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix">
                    <div class="heading">
                        <i class="fa fa-table"></i>Audit Trail
                    </div>
                    <div class="widget-content padded clearfix">

                        <table class="table table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Operation</th>
                                <th>Entity</th>
                                <th width="30%">User Agent</th>
                                <th></th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($audits AS $audit)
                                <tr>
                                    <td>{{$audit->created_at}}</td>
                                    <td>{{!is_null($audit->user) ? $audit->user->username : "Anonymous"}} [{{$audit->ip_address}}]</td>
                                    <td>{{ucfirst($audit->event)}}</td>
                                    <td>{{ucwords(getAuditName($audit->auditable_type))}}</td>
                                    <td>{{$audit->user_agent}}</td>

                                    <td class="actions">
                                        <div class="action-buttons">
                                            <a class="table-actions" title="View" href="{{ getAuditRoute($audit)  }}"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$audits->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end DataTables Example -->

    </div>

@endsection