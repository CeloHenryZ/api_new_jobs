<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;
    protected $redirect = false;
    protected $redirectRoute = false;

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
            'name' => 'required|exists:App\Models\User,name',
            'password' => 'required'
        ];
    }

    public function messages() {
        return [
            "name.required" => "campo nome é obrigatório",
            "name.exists" => "Usuário não cadastrado",

            "password.required" => "campo senha é obrigatório",

        ];
    }
}
