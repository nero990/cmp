<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name', 'Question') !!}
                {!! Form::text('question', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Response Type', 'Address') !!}
                {!! Form::select('response_type', $response_type_list, null, ['class' => 'form-control']) !!}
            </div>

        </div>
    </div>
    <input class="btn btn-warning" type="submit" value="Save">
</fieldset>