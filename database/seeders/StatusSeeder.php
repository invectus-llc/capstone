<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status')->insert(['status' => 'paid', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'pending', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'booked', 'created_at'=>now(), 'updated_at'=>now()]);
    }
}
