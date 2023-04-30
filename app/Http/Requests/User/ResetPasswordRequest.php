<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => ['required',  'email','exists:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле :attribute обязательно для заполенения!',
            'email.email' => 'Поле :attribute должно быть формата Электронной Почты!',
            'password.min' => 'Поле :attribute должно состоять минимум из 8-х символов!',
            'email.exists' => 'Пользователь с такой почтой не существует!',
            'password.confirmed' => 'Введенные пароли не совпадают!',
        ];
    }
}
