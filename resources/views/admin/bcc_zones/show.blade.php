@extends('admin.layout.main')

@section('current_bcc_zones') class="current" @endsection

@section('title') {{$bcc_zone->name}} Zone @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>BCC Zone Management</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>{{$bcc_zone->name}} Zone
                    </div>

                    <div class="widget-content padded">

                        <div class="col-sm-6">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <td>{{$bcc_zone->name}}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{$bcc_zone->address}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><span class="label @if($bcc_zone->status =="1") {{"label-success"}} @else {{ "label-danger" }} @endif">{{$bcc_zone->status_text}}</span></td>
                                </tr>
                                <tr>
                                    <th>Families Count</th>
                                    <td>{{$bcc_zone->families()->count()}}</td>
                                </tr>
                            </table>

                        </div>

                        <div class="col-sm-6">
                            <table class="table table-striped">
                                <tr>
                                    <th>Streets</th>
                                    <td>{!! implode("<br>", $bcc_zone->streets)  !!}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-12">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
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
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($bcc_zone->families AS $key => $family)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$family->name}}</td>
                                        <td>{{$family->type_text}}</td>
                                        <td>{{$family->registration_number}}</td>
                                        <td>{{$family->head->full_name}}</td>
                                        <td>{!! implode("<br>", $family->head->phones)  !!}}</td>
                                        <td class="hidden-xs text-center">{{($family->type == "1") ? $family->number_of_children : "-"}}</td>
                                        <td class="hidden-xs">{{$family->address}}</td>
                                        <td class="hidden-xs"><span class="label @if($family->card_status == "0") {{"label-danger"}} @elseif($family->card_status == "1") {{ "label-info" }} @else {{ "label-success" }} @endif">{{$family->card_status_text}}</span></td>

                                        <td class="actions">
                                            <div class="action-buttons">
                                                <a class="table-actions" title="View" href="{{route('families.show', ['id' => $family->id])}}"><i class="fa fa-eye"></i></a>
                                                <a class="table-actions" title="Edit" href="{{route('families.edit', ['id' => $family->id])}}"><i class="fa fa-pencil"></i></a>
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