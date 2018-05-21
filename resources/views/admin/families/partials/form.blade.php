<fieldset>
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
                    {!! Form::label('address', 'Address') !!}
                    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '5']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state', 'State') !!}
                    {!! Form::select('state', $state_list, null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('bcc_zone', 'BCC Zone') !!}
                    {!! Form::select('bcc_zone', $bcc_zone_list, null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('card_status', 'Card Status') !!}
                    {!! Form::select('card_status', $card_status_list, null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                </div>
            </fieldset>

        </div>

        <div class="col-md-4">
            <fieldset>
                <legend>Family Head Details</legend>
                <div class="form-group">
                    {!! Form::label('first_name', 'First Name') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('middle_name', 'Middle Name') !!}
                    {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('last_name', 'Last Name') !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('gender', 'Gender') !!}

                    <div>
                        <label class="radio-inline">
                            {!! Form::radio('gender', 'M') !!}
                            <span>Male</span>
                        </label>
                        <label class="radio-inline">
                            {!! Form::radio('gender', 'F') !!}
                            <span>Female</span>
                        </label>
                    </div>

                </div>

                <div class="form-group">
                    {!! Form::label('marital_status', 'Marital Status') !!}
                    {!! Form::select('marital_status', $marital_status_list, null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('age_group', 'Age Group') !!}
                    {!! Form::select('age_group', $age_group_list, null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('occupation', 'Occupation') !!}
                    {!! Form::text('occupation', null, ['class' => 'form-control']) !!}
                </div>
            </fieldset>

        </div>

        <div class="col-md-4">
            <fieldset>
                <legend>Contact Details</legend>
                <div class="form-group">
                    {!! Form::label('email', 'Email Address') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="phones">Phones <small><em>(If more than one, separate with a comer)</em></small></label>
                    {!! Form::text('phones', null, ['class' => 'form-control']) !!}
                </div>


                <legend>Other Details</legend>

                <div class="form-group" id="childrenBlock" style="display: none;">
                    <label for="children">Names Children below 16 years</label>
                    <button type="button" class="btn btn-default btn-xs" onclick="duplicate()"><i class="fa fa-plus-circle"></i> Add More</button>
                    <button type="button" class="btn btn-outline-danger btn-xs" onclick="remove()"><i class="fa fa-minus-circle"></i> Remove</button>
                    <div>
                        @if(isset($family))
                            @foreach($family->streets AS $street)
                                {!! Form::text('children[]', $street, ['class' => 'form-control', 'id' => 'origin', 'style' => 'margin-bottom: 5px']) !!}
                            @endforeach
                        @else
                            {!! Form::text('children[]', null, ['class' => 'form-control', 'id' => 'origin', 'style' => 'margin-bottom: 5px']) !!}
                        @endif

                    </div>
                </div>
            </fieldset>

        </div>

    </div>
    <input class="btn btn-warning" type="submit" value="Save">
</fieldset>