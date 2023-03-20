<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'email' => ['required',  'email','unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'remember' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле :attribute обязательно для заполенения!',
            'email.required' => 'Поле :attribute обязательно для заполенения!',
            'email.email' => 'Поле :attribute должно быть формата Электронной Почты!',
            'password.required' => 'Поле :attribute обязательно для заполенения!',
            'name.min' => 'Поле :attribute должно состоять минимум из 3-х символов!',
            'password.min' => 'Поле :attribute должно состоять минимум из 8-х символов!',
            'email.unique' => 'Пользователь с такой почтой уже существует!',
            'password.confirmed' => 'Введенные пароли не совпадают!',
        ];
    }
}
