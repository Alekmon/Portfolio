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
            'image' => ['required', 'mimes:jpeg,png,jpg'],
            'name' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'image' => 'Изображение',
            'description' => 'Описание',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле :attribute обязательно для заполенния!',
            'image.required' => 'Поле :attribute обязательно для заполенния!',
            'description.required' => 'Поле :attribute обязательно для заполенния!',
            'name.min' => 'Поле :attribute должно состоять минимум из 3-х символов!',
            'name.mimes' => 'Поле :attribute должно быть формата JPEG, PNG, JPG!',
        ];
    }
}
