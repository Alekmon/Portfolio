<?php

namespace App\Enums;

enum TableLocation: string
{
    case Передний = 'front';
    case Внутри = 'inside';
    case Снаружи = 'outside';

    public static function match(int $int): static
    {
        return match ($int) {
            1 => static::Передний,
            2 => static::Внутри,
            3 => static::Снаружи,
        };
    }
}