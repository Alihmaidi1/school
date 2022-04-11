<?php

namespace App\Http\Requests\parents;

use Illuminate\Foundation\Http\FormRequest;

class add_parent extends FormRequest
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


            "email"=>"required|email",
            "password"=>"required",
            "father_name"=>"required",
            "mother_name"=>"required",
            "title_father"=>"required",
            "title_mother"=>"required",
            "father_nationality"=>"required",
            "father_job"=>"required",
            "father_number"=>"required",
            "mother_nationality"=>"required",
            "mother_job"=>"required",
            "mother_number"=>"required",
            


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


