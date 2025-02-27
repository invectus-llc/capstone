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
            $table->string('firstname');
            $table->string('lastname');
            $table->bigInteger('contact_no');
            $table->unsignedInteger('login_id')->nullable();
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('usertype_id')->nullable();
            $table->foreign('usertype_id')->references('id')->on('usertype')->onDelete('cascade')->onUpdate('cascade');
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
