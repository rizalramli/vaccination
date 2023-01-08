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
        $check_admin = \App\Models\User::where('email', 'admin')->first();

        if($check_admin) {
            $check_admin->delete();
        }

        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        $admin->assignRole('admin');
    }
}
