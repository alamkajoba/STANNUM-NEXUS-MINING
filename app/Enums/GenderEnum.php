<?php

namespace App\Enums;

enum GenderEnum :string
{
    case M = 'homme';
    case F = 'femme';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
