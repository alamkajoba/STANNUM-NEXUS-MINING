<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Brick\Money\Money;

class MoneyCast implements CastsAttributes
{
    /**
     * datas to model (read)
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Money
    {
        if ($value === null) {
            return null;
        }

        // Change centimes saved in object Money USD
        return Money::ofMinor($value, 'USD');
    }

    /**
     * datas to model (create)
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        // If is already Money Object, catch centimes
        if ($value instanceof Money) {
            return $value->getMinorAmount()->toInt();
        }

        // If is string, clear and convert
        if (is_string($value)) {
            $value = preg_replace('/[^0-9.-]/', '', $value);
        }

        return Money::of($value, 'USD')->getMinorAmount()->toInt();
    }
}