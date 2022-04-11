<?php

namespace App\Http\Requests\students;

use Illuminate\Foundation\Http\FormRequest;

class add_student extends FormRequest
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

            "Email"=>"required|email",
            "Password"=>"required",
            "Name_ar"=>"required",
            "Name_en"=>"required",
            "age"=>"required",
            "parents_id"=>"required",
            "Gender"=>"required",
            "section_id"=>"required",
            "Address"=>"required"

        ];
    }


    public function messages()
    {

        return [

            "required"=>trans("validation.required"),
            "email"=>trans("validation.email")

        ];


    }
}
