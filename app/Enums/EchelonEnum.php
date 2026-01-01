<?php

namespace App\Enums;

enum EchelonEnum :string
{
    case I = '1';
    case II = '2';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
