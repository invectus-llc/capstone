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
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->unsignedInteger('login_id')->nullable();
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('logins');
    }
};
