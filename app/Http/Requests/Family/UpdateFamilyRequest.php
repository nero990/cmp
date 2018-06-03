<?php

namespace App\Http\Requests\Family;

use App\Family;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFamilyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required|in:1,2',
            'family_head' => 'required',
            'state' => 'nullable|exists:states,id',
            'card_status' => 'required|in:0,1,2',
            'bcc_zone' => 'required|exists:bcc_zones,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(!empty($this->get('family_head'))) {
                if(!$this->family->members->find($this->get('family_head')))
                    $validator->errors()->add('family_head', "Selected member doesn't belong to this family.");
            }
        });

    }
}
