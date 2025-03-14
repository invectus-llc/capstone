<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PHPUnit\TextUI\XmlConfiguration\SuccessfulSchemaDetectionResult;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->bigInteger('contact_no');
            $table->unsignedInteger('login_id')->nullable();
            $table->enum('user_type', ['admin', 'manager', 'user'])->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
