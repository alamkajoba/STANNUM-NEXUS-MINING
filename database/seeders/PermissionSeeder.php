<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'users' =>
            ['creer un utilisateur',
            'modifier un utilisateur',
            'supprimer un utilisateur',
            'voir un utilisateur'],

            'category' =>
            ['creer une categorie',
            'modifier une categorie',
            'supprimer une categorie',
            'voir une categorie'],

            'employee' =>
            ['creer un  agent',
            'modifier un  agent',
            'supprimer un  agent',
            'voir un  agent'],

            'permission' =>
            ['peut attribuer une permission'],

            'payment and slipPay' =>
            ['effectuer un paiement',
            'modifier un paiement',
            'supprimer un paiement',
            'voir un  paiement',
            'imprimer un bulletin de paie'],

            'family' =>
            ['creer un membre de famille',
            'modifier un membre de famille',
            'supprimer un membre de famille',
            'voir un  membre de famille'],

            ['deduction' =>
            'creer les deduction',
            'voir les deduction',
            'modifier les deduction'],
            
            'advance' =>
            ['effectuer une avance sur salaire',
            'modifier une avance sur salaire',
            'liste avance sur salaire',
            "imprimer un bulletin d'avance sur salaire"],
        ];

        foreach ($permissions as $group => $perms) {
            foreach ($perms as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission,
                    'group_name' => $group,
                ]);
            }
        }
    }
}
