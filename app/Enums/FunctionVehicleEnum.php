<?php

namespace App\Enums;

enum FunctionVehicleEnum :string
{
    case TRUE = 'oui';
    case FALSE = 'non';

    public static function values(): array
    {
        return array_column(self::cases(), 'values');
    }
}
