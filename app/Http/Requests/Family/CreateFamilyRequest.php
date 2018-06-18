<?php

namespace App\Http\Requests\Family;

use Illuminate\Foundation\Http\FormRequest;

class CreateFamilyRequest extends FormRequest
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
            'state' => 'nullable|exists:states,id',
            'card_status' => 'nullable|in:0,1,2',
            'bcc_zone' => 'nullable|exists:bcc_zones,id',

            // Member files (Family head)
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email',
            'phones' => 'required',
            'gender' => 'nullable|in:M,F',
            'marital_status' => 'nullable|in:1,2,3,4,5,6',
            'age_group' => 'nullable|in:1,2,3,4,5,6,7,8',
            'church_engagements' => 'nullable|array|exists:church_engagements,id'
        ];
    }
}
