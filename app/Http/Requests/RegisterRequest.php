<?php

namespace App\Http\Requests;

use App\Rules\TypeUser;
use App\Rules\VerifyName;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;
    protected $redirect = false;
    protected $redirectRoute = false;


    public function verifyCpfOrCnpj(RegisterRequest $data)
    {
        $type = $data->type;

        $messages = [
            "cpf.cpf" => "o campo cpf não é válido",
            "cpf.required" => "cpf é um campo obrigatorio",
            "cpf.unique" => "esse cpf já está cadastrado",
            "cpf.declined" => "o campo cpf deve ser enviado com '0', 'false', 'no', ou 'off'",

            "cnpj.cnpj" => "o campo cnpj não é válido",
            "cnpj.required" => "o campo cnpj é obrigatório",
            "cnpj.unique" => "esse cnpj já está cadastrado",
            "cnpj.declined" => "o campo cnpj deve ser enviado com '0', 'false', 'no', ou 'off'"
        ];

        if ($type == "pessoa_fisica") {
            return $data->validate([
                "cpf" => 'required|cpf|unique:users,cpf',
                "cnpj" => 'declined'
            ], $messages);
        }
        if ($type == "pessoa_juridica") {
           return $data->validate([
                "cnpj" => 'required|cnpj|unique:users,cnpj',
                "cpf" => 'declined'
            ], $messages);
        }
    }

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
            //'cpf' => 'required|cpf_ou_cnpj|formato_cpf_ou_cnpj|unique:users,cpf',
            'name' => ['required', 'min:5', 'max:100', new VerifyName],
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:5|max:100',
            'type' => ['required', new TypeUser]
        ];
    }

    public function messages()
    {
        return [
            //'cpf.required' => 'o campo cpf é obrigatorio',
            //'cpf.unique' => 'número de cpf já cadastrado',

            'name.required' => 'o campo nome é obrigatorio',
            'name.min' => 'Digite um nome válido',

            'password.required' => "o campo senha é obrigatorio",
            'password.min' => 'a senha deve ter no minimo 5 caracteres',
            'password.confirmed' => 'a confirmação e senha não são iguais',
            'password_confirmation.required' => 'confirmação de senha obrigatoria',

            'email.required' => 'o campo Email é obrigatório',
            'email.email' => "Email inválido",

            "type.required" => "o campo type é obrigatorio"
        ];
    }
}
