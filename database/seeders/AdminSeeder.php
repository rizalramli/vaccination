<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();
        
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        $admin->assignRole('admin');
    }
}
