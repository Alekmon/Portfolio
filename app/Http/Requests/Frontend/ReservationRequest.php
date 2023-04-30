<?php

namespace App\Http\Requests\Frontend;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'tel_number' => ['required'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'guest_number' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Почта',
            'tel_number' => 'Номер Телефона',
            'res_date' => 'Дата Бронирования',
            'guest_number' => 'Колличество Гостей',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Поле :attribute обязательно для заполнения!',
        ];
    }
}
