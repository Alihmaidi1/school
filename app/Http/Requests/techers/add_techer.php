<?php

namespace App\Http\Requests\techers;

use Illuminate\Foundation\Http\FormRequest;

class add_techer extends FormRequest
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
            "number"=>"required",
            "salary_id"=>"required",
            "specialization"=>"required",
            "Gender"=>"required",
            "Joining_Date"=>"required",
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
