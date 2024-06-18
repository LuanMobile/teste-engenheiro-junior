<?php

namespace App\Http\Requests;

use App\Rules\FullName;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', new FullName],
            'email'     => 'required|email|unique:users',
            'password'  => [
                'required',
                Password::min(6)
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => "O campo 'nome' é obrigatório",
            'name.string'       => "O campo 'nome' deve ser uma string",
            'name.min'          => "O campo 'nome' deve ter pelo menos 10 caracteres.",
            'email.required'    => "O campo 'email' é obrigatório.",
            'email.email'       => "O campo 'email' deve ser um endereço de e-mail válido.",
            'email.unique'      => "O 'email' já foi usado.",
            'password.required' => "O campo 'senha' é obrigatório.",
            'password.min'      => "O campo 'password' deve ter no mínimo 6 caracteres.",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()->all()
        ], 400));
    }
}
