<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('logins')->insert(['username'=>'admin', 'password'=>'admin','created_at'=>now(), 'updated_at'=>now()]);
        DB::table('users')->insert([
            'email'=>'admin@admin.com',
            'firstname'=>'admin',
            'lastname'=>'admin',
            'contact_no'=>9451237896,
            'login_id'=>1,
            'usertype_id'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
