<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePresentAcademicStatus extends FormRequest
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
            'academic_rank' => 'required|numeric',
            'employment_status' => 'required',
            'year_appointed_in_ust' => 'required|digits:4|integer|min:1800|max:'.(date('Y')+1),
            'num_of_years_in_ust' => 'required|numeric',
            'pos_in_ust' => 'required'
        ];
    }
}
