<fieldset>
    <legend>Sacrament Details</legend>

    @foreach($sacrament_question_list AS $key => $sacrament_question)
        <div class="form-group">
            {!! Form::label('sacrament_question_' . $key, $sacrament_question) !!}

            @php
                $yes = $no = '';

                if(isset($member)){
                    $q = $member->member_sacrament_questions->keyBy('sacrament_question_id')->toArray();
                    if(isset($q[$key])) {
                        if($q[$key]['response'] == 1) $yes = true;
                        else $no = true;
                    }
                }
            @endphp
            <div>
                <label class="radio-inline">
                    {!! Form::radio('sacrament_question_' . $key, '1', $yes) !!}
                    <span>Yes</span>
                </label>
                <label class="radio-inline">
                    {!! Form::radio('sacrament_question_' . $key, '0', $no) !!}
                    <span>No</span>
                </label>
            </div>
        </div>
    @endforeach
</fieldset>