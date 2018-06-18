@extends('admin.layouts.main')

@section('title') Edit Family @endsection
@section('current_families') class="current" @endsection

@section('content')
    <div class="container-fluid main-content">
        <div class="page-title">
            <h1>Edit Family</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container">
                    <div class="heading">
                        <i class="fa fa-shield"></i>{{$family->name}}
                    </div>
                    <div class="widget-content padded">

                        <div id="message"></div>
                        @include('errors.list')

                        {!! Form::model($family, ['route' => ['families.update', $family->id], 'method' => 'PUT', 'id' => 'familyUpdate']) !!}

                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="">
                                    <legend>Family Details</legend>
                                    <div class="form-group">
                                        {!! Form::label('name', 'Family Name') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('type', 'Type') !!}

                                        <div>
                                            <label class="radio-inline">
                                                {!! Form::radio('type', '1', false, ['class'=>'family-type']) !!}
                                                <span>Family</span>
                                            </label>
                                            <label class="radio-inline">
                                                {!! Form::radio('type', '2', false, ['class'=>'family-type']) !!}
                                                <span>Individual</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('name', 'Family Head') !!}

                                        {!! Form::select('family_head', $family_members, $family_head_id, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('address', 'Address') !!}
                                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('state', 'State') !!}
                                        {!! Form::select('state', $state_list, $family->state_id, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('bcc_zone', 'BCC Zone') !!}
                                        {!! Form::select('bcc_zone', $bcc_zone_list, $family->bcc_zone_id, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('card_status', 'Card Status') !!}
                                        {!! Form::select('card_status', $card_status_list, null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                                    </div>

                                </fieldset>

                                <fieldset id="childrenBlock"  @if($family->type == "2") style="display: none;" @endif>
                                    <legend>Children</legend>

                                    <div class="form-group">
                                        <label for="children">Names of Children below 16 years</label>
                                        <button type="button" class="btn btn-default btn-xs" onclick="duplicate()"><i class="fa fa-plus-circle"></i> Add More</button>
                                        <button type="button" class="btn btn-outline-danger btn-xs" onclick="remove()"><i class="fa fa-minus-circle"></i> Remove</button>
                                        <div>
                                            @if($family->type == "1")
                                                @foreach($family->names_of_children AS $child)
                                                    {!! Form::text('children[]', $child, ['class' => 'form-control', 'id' => 'origin', 'style' => 'margin-bottom: 5px']) !!}
                                                @endforeach
                                            @else
                                                {!! Form::text('children[]', null, ['class' => 'form-control', 'id' => 'origin', 'style' => 'margin-bottom: 5px']) !!}
                                            @endif

                                        </div>
                                    </div>

                                </fieldset>

                            </div>

                            <div class="col-md-8">
                                <table class="table table-striped" id="dataTable1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Marital Status</th>
                                        <th>Role</th>
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

                                            <td class="actions">
                                                <div class="action-buttons">
                                                    <a class="table-actions" title="View" href="{{route('families.members.show', ['id' => $member->id])}}"><i class="fa fa-eye"></i></a>
                                                    <a class="table-actions" title="Edit" href="{{route('families.members.edit', ['id' => $member->id])}}"><i class="fa fa-pencil"></i></a>
                                                    <a class="table-actions" href=""><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <input class="btn btn-warning" type="submit" value="Save">



                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/family.js')}}" type="text/javascript"></script>
@endsection