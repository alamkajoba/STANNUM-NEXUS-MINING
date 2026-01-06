<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Brick\Money\Money;

class MoneyCast implements CastsAttributes
{
    /**
     * Transformation DE la base de données VERS le modèle (Lecture)
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Money
    {
        if ($value === null) {
            return null;
        }

        // On transforme les centimes stockés en base en objet Money USD
        return Money::ofMinor($value, 'USD');
    }

    /**
     * Transformation DU modèle VERS la base de données (Écriture)
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Si c'est déjà un objet Money, on récupère les centimes
        if ($value instanceof Money) {
            return $value->getMinorAmount()->toInt();
        }

        // Si c'est une string (ex: venant de Livewire), on nettoie et on convertit
        if (is_string($value)) {
            $value = preg_replace('/[^0-9.-]/', '', $value);
        }

        return Money::of($value, 'USD')->getMinorAmount()->toInt();
    }
}