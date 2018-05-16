@extends('admin.layout.main')
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
                    <a href="{{route('families.create')}}" class="btn btn-warning"><span class="fa fa-plus"></span> New Family</a>

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
                        @foreach($families AS $key => $family)
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
                    {{$families->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- end DataTables Example -->

</div>

@endsection