<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMusicianWaitlistRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'instagram' => 'required|string|unique:musicians_waitlist',
            'phone' => 'required|string|unique:musicians_waitlist',
            'extra_link' => 'nullable|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'description.required' => 'O campo descrição é obrigatório',
            'instagram.required' => 'O campo instagram é obrigatório',
            'instagram.unique' => 'O instagram informado já está cadastrado',
            'phone.required' => 'O campo telefone é obrigatório',
            'phone.unique' => 'O telefone informado já está cadastrado'
        ];
    }
}
