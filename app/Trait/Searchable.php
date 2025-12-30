<?php

namespace App\Trait;

trait Searchable
{
    public function scopeSearch($query, $term)
    {
        if (!$term) return $query;

        return $query->where(function ($query) use ($term) {
            $searchTerm = '%' . $term . '%';
            
            // Recherche dans les colonnes de la table principale
            foreach ($this->searchableColumns ?? [] as $column) {
                $query->orWhere($column, 'like', $searchTerm);
            }

            // Recherche dans les relations (optionnel)
            $this->searchInRelations($query, $searchTerm);
        });
    }

    protected function searchInRelations($query, $searchTerm)
    {
        // On vérifie si le modèle définit des relations à fouiller
        foreach ($this->searchableRelations ?? [] as $relation => $column) {
            $query->orWhereHas($relation, function ($q) use ($column, $searchTerm) {
                $q->where($column, 'like', $searchTerm);
            });
        }
    }
}
