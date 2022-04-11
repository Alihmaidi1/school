<?php

namespace App\Http\Requests\classes;

use Illuminate\Foundation\Http\FormRequest;

class add_class extends FormRequest
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

            "List_Classes"=>"array",
            "List_Classes.*"=>"array|min:3",
            "List_Classes.*.*"=>"required|min:1"


        ];
    }

    public function messages()
    {
        return [

            "required"=>trans("validation.required")

        ];
    }

}
