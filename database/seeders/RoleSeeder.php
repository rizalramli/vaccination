<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'employee',
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::updateOrCreate(['name' => $role]);
        }
    }
}
