<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Alam kajoba',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        // $adminRole = Role::firstOrCreate(['name' => 'Top Admin']);
        // $adminRole->syncPermissions(Permission::all());
        // $user->assignRole($adminRole);
    }
}
