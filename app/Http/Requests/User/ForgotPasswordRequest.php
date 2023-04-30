<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email']
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Почта',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле :attribute обязательно для заполнения!',
            'email.email' => 'Поле :attribute должно быть формата емэйл!',
            'email.exists' => 'Пользователя с такой почтой не существует!',
        ];
    }
}
