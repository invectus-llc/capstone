<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usertype')->insert(['usertype'=>'admin', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('usertype')->insert(['usertype'=>'client', 'created_at'=>now(), 'updated_at'=>now()]);
    }
}
