<?php

namespace App\Http\Requests\Family;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        $value = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email',
            'phones' => 'required',
            'gender' => 'nullable|in:M,F',
            'marital_status' => 'required|in:1,2,3,4,5,6',
            'age_group' => 'required|in:1,2,3,4,5,6,7,8',
            'church_engagements' => 'nullable|array|exists:church_engagements,id',
            'deceased' => 'nullable|in:0,1',
            'deceased_at' => 'required_if:deceased,1|nullable|date_format:Y-m-d'
        ];

        if($this->getMethod() == "POST" || (isset($this->member) && !$this->member->role->is_head)) {
            $value['family_role'] = [
                'required',
                Rule::exists('member_roles', 'id')->where(function ($query) {
                    $query->where('name', '<>', 'Head');
                }),
            ];
        }

        return $value;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'deceased_at.required_if' => 'Deceased date is required if member is deceased.',
            'deceased_at.date_format' => 'The deceased date does not match the format yyyy-mm-dd.',
        ];
    }
}
