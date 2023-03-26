<?php

namespace App\Http\Requests\Admin\Menu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'image' => ['image', 'mimes:jpeg,png,jpg'],
            'description' => ['required'],
            'price' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'image' => 'Изображение',
            'description' => 'Описание',
            'price' => 'Цена',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле :attribute обязательно для заполенния!',
            'description.required' => 'Поле :attribute обязательно для заполенния!',
            'name.min' => 'Поле :attribute должно состоять минимум из 3-х символов!',
            'image.mimes' => 'Поле :attribute должно быть формата JPEG, PNG, JPG!',
            'price.required' => 'Поле :attribute обязательно для заполенния!',
        ];
    }
}
