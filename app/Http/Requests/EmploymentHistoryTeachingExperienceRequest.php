<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmploymentHistoryTeachingExperienceRequest extends FormRequest
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
            'institution' => 'required',
            'subject_taught' => 'required',
            'period_of_employment_from' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'academic_rank' => 'required'
        ];
    }
}
