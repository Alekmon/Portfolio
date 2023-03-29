<?php

namespace App\Rules;

use App\Models\Table;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class GuestCheck implements ValidationRule, DataAwareRule
{

    protected array $data;

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $table = Table::findOrFail($this->data['table_id']);
        if($value > $table->guest_number){
            $fail('Колличество гостей превышает колличество мест!');
        }
    }
}
