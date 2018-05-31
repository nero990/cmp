<fieldset>
    <legend>Sacrament Details</legend>
    @foreach($sacrament_question_list AS $key => $sacrament_question)
        <div class="form-group">
            {!! Form::label('sacrament_question_' . $key, $sacrament_question) !!}

            <div>
                <label class="radio-inline">
                    {!! Form::radio('sacrament_question_' . $key, '1') !!}
                    <span>Yes</span>
                </label>
                <label class="radio-inline">
                    {!! Form::radio('sacrament_question_' . $key, '0') !!}
                    <span>No</span>
                </label>
            </div>
        </div>
    @endforeach
</fieldset>