<?php

namespace App\Http\Requests;

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
            "name" => "required|min:3|string",
            "last_name" => "required|min:3|string",
            "email" => "email:rfc,dns|string",
            "phone_number" => "required|telefone_com_ddd|string",
            "experience" => "required|min:10|max:2000|string",
            "schooling" => "required|string",
            "skills" => "required|string",
        ];
    }

    public function messaeges()
    {
        return [
                "name.required" => "o campo name é obrigatório",
                "name:min" => "o campo"
        ];

    }
}
