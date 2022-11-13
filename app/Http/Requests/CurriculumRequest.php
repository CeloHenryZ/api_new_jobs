<?php

namespace App\Http\Requests;

use App\Rules\ArrayJson;
use App\Rules\VerifyName;
use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
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
            "name" => ["required","string", new VerifyName],
            "email" => "email:rfc,dns|string|required",
            "phone_number" => "required|celular_com_ddd|string",
            "experience" => new ArrayJson([
                "years" => "integer|required",
                "companies" => "array|required"
            ]),
            "experience.years" => "integer",
            "experience.companies" => "array",
            "schooling" => "required|string",
            "skills" => "required|string",
        ];
    }

    public function messages()
    {
        return [

        ];

    }
}
