@extends('admin.layouts.main')
@section('current_families') class="current" @endsection
@section('title') Family of {{$family->name}} @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Family Details for: [{{$family->name}}]</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>{{$family->name}} Family
                    </div>

                    <div class="widget-content padded">

                        @include('errors.list')

                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <td>{{$family->name}}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{$family->type_text}}</td>
                                </tr>
                                <tr>
                                    <th>Reg. Number</th>
                                    <td>{{$family->registration_number}}</td>
                                </tr>
                                <tr>
                                    <th>BCC Zone</th>
                                    <td>
                                        @if($family->bcc_zone)
                                        <a href="{{route('bcc-zones.show', ['id' => $family->bcc_zone->id])}}">{{$family->bcc_zone->name}}</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Card Status</th>
                                    <td><span class="label @if($family->card_status == "0") {{"label-danger"}} @elseif($family->card_status == "1") {{"label-success"}} @else {{"label-info"}}  @endif"> {{$family->card_status_text}}</span></td>
                                </tr>
                            </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <tr>
                                    <th>Family Head</th>
                                    <td><a href="{{route('families.members.show', ['family' => $family->head->id])}}">{{$family->head->full_name}}</a></td>
                                </tr>
                                <tr>
                                    <th>Phones</th>
                                    <td>{{implode(", ", $family->head->phones)}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{$family->address}}</td>
                                </tr>
                                @if($family->type == "1")
                                    <tr>
                                        <th>Children below 16 years</th>
                                        <td>{!! implode(", ", $family->names_of_children) !!}</td>
                                    </tr>
                                @endif
                            </table>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-12">

                            <a href="{{route('families.edit', $family->id)}}" class="btn btn-warning" style="margin-top: 10px"><span class="fa fa-pencil"></span> Edit this Family</a>
                            <a href="{{route('families.members.create', $family->id)}}" class="btn btn-success" style="margin-top: 10px"><span class="fa fa-plus"></span> New Member</a>
                            <a href="{{route('families.audits', $family->id)}}" class="btn btn-info" style="margin-top: 10px"><span class="fa fa-archive"></span> View Audit Trail</a>

                            <div class="table-responsive">
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
                                    @foreach($family->members AS $key => $member)
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
                                                <div class="action-buttons" style="width: 120px;">
                                                    <a class="table-actions" title="View" href="{{route('families.members.show', ['id' => $member->id])}}"><i class="fa fa-eye"></i></a>
                                                    <a class="table-actions" title="Edit" href="{{route('families.members.edit', ['id' => $member->id])}}"><i class="fa fa-pencil"></i></a>
                                                    <a class="table-actions" title="View Audit Trail" href="{{route('families.members.audits', ['id' => $member->id])}}"><i class="fa fa-archive"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection