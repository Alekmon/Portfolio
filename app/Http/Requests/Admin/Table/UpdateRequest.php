<?php

namespace App\Http\Requests\Admin\Table;

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
            'name' => 'required',
            'guest_number' => 'required',
            'status' => 'required',
            'location' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'guest_number' => 'Колличество Гостей',
            'status' => 'Статус',
            'location' => 'Место',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле :attribute обязательно для заполнения!',
            'guest_number.required' => 'Поле :attribute обязательно для заполнения!',
            'status.required' => 'Поле :attribute обязательно для заполнения!',
            'location.required' => 'Поле :attribute обязательно для заполнения!',
        ];
    }
}
