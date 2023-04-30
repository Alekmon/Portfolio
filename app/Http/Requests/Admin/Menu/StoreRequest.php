<?php

namespace App\Http\Requests\Admin\Menu;

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
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg'],
            'description' => ['required'],
            'price' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'image' => 'Изображение',
            'description' => 'Описание',
            'price' => 'Цена',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле :attribute обязательно для заполнения!',
            'name.min' => 'Поле :attribute должно состоять минимум из 3-х символов!',
            'image.mimes' => 'Поле :attribute должно быть формата JPEG, PNG, JPG!',
        ];
    }
}
