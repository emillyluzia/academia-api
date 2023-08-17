<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:80|min:5',
            'cpf' => 'required|max:15|min:11|unique:cliente_models,cpf,'. $this->input('cpf'),
            'celular' => 'required|max:15|min:10',
            'email' => 'required|email|unique:cliente_models,email,'. $this->input('email'),
            'password' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O campo nome deve conter no maximo 80 caracteres',
            'nome min' => 'O campo nome deve conter no mínimo 5 caracteres',
            'cpf.required' => 'CPF obrigatório',
            'cpf.max' => 'O cpf nome deve conter no maximo 11 caracteres',
            'cpf.min' => 'O cpf nome deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF já cadastrado no sistema ',
            'celular.required' => 'Celular obrigatório',
            'celular.max' => 'O celular nome deve conter no maximo 15 caracteres',
            'celular.min' => 'O celular nome deve conter no mínimo 10 caracteres',
            'email.required' => 'E-mail obrigatório',
            'email.email' => 'Formato de email invalido',
            'email.unique' => 'E-mail já cadastrado no sistema',
            'password.requited' => 'Senha obrigatória'

        ];
    }
}
