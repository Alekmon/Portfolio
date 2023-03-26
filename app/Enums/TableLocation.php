<?php

namespace App\Enums;

enum TableLocation: string
{
    case Передний = 'front';
    case Внутри = 'inside';
    case Снаружи = 'outside';
}