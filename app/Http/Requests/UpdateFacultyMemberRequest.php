<?php

namespace App\Http\Requests;

use App\PersonalParticular;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFacultyMemberRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'place_birth' => 'required',
            'sex' => 'required',
            'religion' => 'required',
            'occupation' => 'required',
            'address' => 'required',
            'telephone' => 'required|numeric',
            'birth' => 'required',
            'citizenship' => 'required',  
            'marital_status' => 'required'
        ];
    }
}
