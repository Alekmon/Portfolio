<?php

namespace App\Enums;

enum TableLocation: string
{
    case Фасад = 'front';
    case Внутри = 'inside';
    case Снаружи = 'outside';

    public static function match(int $int): static
    {
        return match ($int) {
            1 => static::Фасад,
            2 => static::Внутри,
            3 => static::Снаружи,
        };
    }
}