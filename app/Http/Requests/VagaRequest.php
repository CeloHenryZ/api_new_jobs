<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VagaRequest extends FormRequest
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
            "title" => "required|min:5|string",
            "description" => "required|min:10|string",
            "necessary_skills" => "required|array",
            "level" => "required|string",
            "experience" => "string"
        ];
    }
}
