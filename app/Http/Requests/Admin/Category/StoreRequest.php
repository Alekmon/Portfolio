<?php

namespace App\Http\Requests\Admin\Category;

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
            'image' => ['required', 'image','mimes:jpeg,png,jpg'],
            'description' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'image' => 'Изображение',
            'description' => 'Описание',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле :attribute обязательно для заполнения!',
            'name.min' => 'Поле :attribute должно состоять минимум из 3-х символов!',
            'name.mimes' => 'Поле :attribute должно быть формата JPEG, PNG, JPG!',
        ];
    }
}
