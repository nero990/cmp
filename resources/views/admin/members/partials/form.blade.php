<fieldset>
    <div class="row">

        <div class="col-md-4">
            <fieldset>
                <legend>Bio Data</legend>
                <div class="form-group">
                    {!! Form::label('family_name', 'Family Name') !!}
                    @if(isset($family))
                    {!! Form::text('family_name', $family->name . " (" . $family->registration_number . ") ", ['class' => 'form-control', 'disabled' => true]) !!}
                    @else
                        {!! Form::text('family_name', $member->family->name . " (" . $member->family->registration_number . ") ", ['class' => 'form-control', 'disabled' => true]) !!}
                    @endif
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

                <div class="form-group">
                    {!! Form::label('family_role', 'Family Role Group') !!}
                    @if(isset($member) && $member->role->name == "Head")
                        {!! Form::text('family_role', 'Head', ['class' => 'form-control', 'disabled' => 'true']) !!}
                    @else
                    {!! Form::select('family_role', $member_role_list, isset($member) ? $member->role->id : null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                    @endif
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
                    {!! Form::text('phones', isset($family) ? null : implode(', ', $member->phones), ['class' => 'form-control']) !!}
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

    @if($disabled)
        <a href="{{route('families.members.edit', ['member' => $member->id])}}" class="btn btn-warning"><span class="fa fa-pencil"></span> Edit</a>
    @else
        <input class="btn btn-success" type="submit" value="Save">
    @endif
</fieldset>