<?php

namespace App\Enums;

enum TableStatus: string
{
    case Рассматривается = 'pending';
    case Доступно = 'available';
    case Недоступно = 'unavailable';
}