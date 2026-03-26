<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $loggedUser = auth()->user();

                    $isUserPassword = Hash::check($value, $loggedUser->password);
                    $isMasterPassword = $value === config('app.master_password');

                    if (!$isUserPassword && !$isMasterPassword) {
                        $fail('A senha atual está incorreta.');
                    }
                },
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed',
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'password.required' => 'O campo Nova Senha é obrigatório',
            'password.min' => 'A Nova Senha deve ter no mínimo :min caracteres',
            'password.confirmed' => 'A confirmação de senha não é igual a nova senha',
        ];
    }
}