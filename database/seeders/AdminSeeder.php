<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('logins')->insert([
            'username' => 'admin',
            'password' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'contact_no' => 9451237896,
            'login_id' => 1,
            'user_type' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
