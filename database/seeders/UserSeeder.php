<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::updateOrInsert(['email' => 'admin@admin.com'], [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('ebVW5hVCpbLnde8J'),
        ]);
    }
}
