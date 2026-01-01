<?php

namespace App\Enums;

enum CategoryProfEnum :string
{
    case I = 'I';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
