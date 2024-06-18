<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:100'],
            'description'   => ['required', 'string', 'max: 220'],
            'price'         => ['required', 'numeric'],
            'category'      => ['required', 'string', 'max:20']
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => "O campo 'nome' é obrigatório.",
            'name.string'               => "O campo 'nome' deve ser uma string.",
            'name.max'                  => "O campo 'nome' deve ter no máximo 100 caracteres.",
            'description.required'      => "O campo 'description' é obrigatório.",
            'description.string'        => "O campo 'description' deve ser uma string.",
            'description.max'           => "O campo 'description' deve ter no máximo 220 caracteres.",
            'price.required'            => "O campo 'price' é obrigatório.",
            'price.decimal'             => "O campo 'price' deve ser numérico e conter 2 casas decimais.",
            'category.required'         => "O campo 'category' é obrigatório.",
            'category.string'           => "O campo 'category' deve ser uma string.",
            'category.max'              => "O campo 'category' deve ter no máximo 20 caracteres.",
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
