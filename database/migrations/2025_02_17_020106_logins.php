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
        Schema::create('logins', function(Blueprint $table){
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
        DB::table('logins')->insert(['username'=>'admin', 'password'=>'admin','created_at'=>now(), 'updated_at'=>now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logins');
    }
};
