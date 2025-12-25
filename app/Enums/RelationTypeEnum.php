<?php

namespace App\Enums;

enum RelationTypeEnum :string
{
    case CONJOINT = 'Conjoint(e)';
    case CHILD = 'Enfant';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
