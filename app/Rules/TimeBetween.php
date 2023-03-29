<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeBetween implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pickDate = Carbon::parse($value);
        $pickTime = Carbon::createFromTime($pickDate->hour, $pickDate->minute, $pickDate->second);

        $open = Carbon::createFromTimeString('18:00:00'); 
        $close = Carbon::createFromTimeString('23:00:00'); 
       
        if (! $pickTime->between($open, $close)){
            $fail('Время должно быть выбрано между 18:00 и 23:00');
        }
    }
}
