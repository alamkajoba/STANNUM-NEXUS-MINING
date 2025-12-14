<?php

namespace App\Enums;

enum MonthEnum: string
{
    case DECEMBRE_2025 = 'DECEMBRE_2025';
    case JANVIER_2026 = 'JANVIER_2026';
    case FEVRIER_2026 = 'FEVRIER_2026';
    case MARS_2026 = 'MARS_2026';
    case AVRIL_2026 = 'AVRIL_2026';
    case MAI_2026 = 'MAI_2026';
    case JUIN_2026 = 'JUIN_2026';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
