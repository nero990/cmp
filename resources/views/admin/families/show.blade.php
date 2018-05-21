@extends('admin.layout.main')
@section('current_families') class="current" @endsection
@section('title') Family of {{$family->name}} @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Family Management</h1>
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
                                        <a href="{{route('bcc-zones.show', ['id' => $family->bcc_zone->id])}}">{{$family->bcc_zone->name}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Card Status</th>
                                    <td><span class="label @if($family->card_status == "0") {{"label-danger"}} @elseif($family->card_status == "1") {{"label-success"}} @else {{"label-info"}}  @endif"> {{$family->card_status_text}}</span></td>
                                </tr>
                            </table>

                        </div>

                        <div class="col-sm-6">
                            <table class="table table-striped">
                                <tr>
                                    <th>Family Head</th>
                                    <td>{{$family->head->full_name}}</td>
                                </tr>
                                <tr>
                                    <th>Phones</th>
                                    <td>{{implode("; ", $family->head->phones)}}</td>
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

                        <div class="clearfix"></div>

                        <div class="col-sm-12">

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
                                        <th>Email</th>
                                        <th>Phones</th>
                                        <th></th>
                                    </tr>

                                </thead>
                                <tbody>
                                @foreach($family->members AS $key => $member)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$member->full_name}}</td>
                                        <td>{{$member->gender}}</td>
                                        <td>{{$member->marital_status}}</td>
                                        <td>{{$member->role->name}}</td>
                                        <td>{{$member->age_group_text}}</td>
                                        <td>{{$member->occupation}}</td>
                                        <td>{{$member->email}}</td>
                                        <td>{!! implode("<br>", $member->phones)  !!}</td>

                                        <td class="actions">
                                            <div class="action-buttons">
                                                <a class="table-actions" title="View" href="{{route('families.show', ['id' => $member->id])}}"><i class="fa fa-eye"></i></a>
                                                <a class="table-actions" title="Edit" href="{{route('families.edit', ['id' => $member->id])}}"><i class="fa fa-pencil"></i></a>
                                                <a class="table-actions" href=""><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

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