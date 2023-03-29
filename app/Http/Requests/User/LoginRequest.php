<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Поле :attribute обязательно для заполенения!',
            'email.email' => 'Поле :attribute должно быть формата Электронной Почты!',
        ];
    }
}
