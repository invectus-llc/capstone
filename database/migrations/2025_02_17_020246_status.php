<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function(Blueprint $table){
            $table->increments('id');
            $table->string('status');
            $table->timestamps();
        });
        DB::table('status')->insert(['status' => 'paid', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'pending', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'booked', 'created_at'=>now(), 'updated_at'=>now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
