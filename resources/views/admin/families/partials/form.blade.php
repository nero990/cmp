<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', 'Address') !!}
                {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '4']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'Status') !!}
                <div class="clearfix"></div>
                <div class="toggle-switch switch-large" data-off="danger" data-off-label='Inactive' data-on="info" data-on-label='Active'>
                    {!! Form::checkbox('status', '1', null, ['class' => 'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                <label for="streets">Streets</label>
                <button type="button" class="btn btn-default btn-xs" onclick="duplicate()"><i class="fa fa-plus-circle"></i> Add More</button>
                <button type="button" class="btn btn-outline-danger btn-xs" onclick="remove()"><i class="fa fa-minus-circle"></i> Remove</button>
                <div>
                    @if(isset($bcc_zone))
                        @foreach($bcc_zone->streets AS $street)
                            {!! Form::text('streets[]', $street, ['class' => 'form-control', 'id' => 'origin', 'style' => 'margin-bottom: 5px']) !!}
                        @endforeach
                    @else
                         {!! Form::text('streets[]', null, ['class' => 'form-control', 'id' => 'origin', 'style' => 'margin-bottom: 5px']) !!}
                    @endif

                </div>
            </div>
        </div>
    </div>
    <input class="btn btn-warning" type="submit" value="Save">
</fieldset>