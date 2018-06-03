<fieldset>
    <div class="row">

        <div class="col-md-4">
            <fieldset>
                <legend>Bio Data</legend>
                <div class="form-group">
                    {!! Form::label('family_name', 'Family Name') !!}
                    {!! Form::text('family_name', $family->name . " (" . $family->registration_number . ") ", ['class' => 'form-control', 'disabled' => true]) !!}
                </div>
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
            </fieldset>

            <fieldset>
                <legend>Other Details</legend>

                <div class="form-group">
                    {!! Form::label('occupation', 'Occupation') !!}
                    {!! Form::text('occupation', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('church_engagements', 'Church Engagement') !!}
                    {!! Form::select('church_engagements[]', $church_engagement_list, null, ['class' => 'select2able', 'multiple' => '']) !!}
                </div>
            </fieldset>

        </div>

        <div class="col-md-4">
            @include('admin.members.partials.sacrament_details')
        </div>

    </div>
    <input class="btn btn-warning" type="submit" value="Save">
</fieldset>