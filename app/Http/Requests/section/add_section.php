<?php

namespace App\Http\Requests\section;

use Illuminate\Foundation\Http\FormRequest;

class add_section extends FormRequest
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

            "Name_Section_Ar"=>"required",
            "Name_Section_En"=>"required",
            "Class_id"=>"required"

        ];
    }

    public function messages()
    {

        return [

            "required"=>trans("validation.required")

        ];

    }
}
