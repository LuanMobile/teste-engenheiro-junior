<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginApiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'     => 'required|email',
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
