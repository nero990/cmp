@extends('admin.layout.main')

@section('title') Church Engagements  @endsection
@section('current_church_engagements') class="current" @endsection
@section('current_church_engagements_index') class="current" @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>Church Engagements</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>Church Engagements List
                </div>
                <div class="widget-content padded clearfix">

                    <table class="table table-bordered table-striped" id="dataTable1">
                        <thead>
                            <th class="check-header hidden-xs">
                                <label><input id="checkAll" name="checkAll" type="checkbox"><span></span></label>
                            </th>
                            <th>Name</th>
                            <th>Date Added</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($members AS $member)
                            <tr>
                                <td class="check hidden-xs">
                                    <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>
                                </td>
                                <td>{{$member->name}}</td>
                                <td>{{$member->created_at->toFormattedDateString()}}</td>
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

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/church-engagement.js')}}" type="text/javascript"></script>
@endsection