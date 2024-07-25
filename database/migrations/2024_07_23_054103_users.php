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
        Schema::create('logins', function(Blueprint $table){
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('status', function(Blueprint $table){
            $table->increments('id');
            $table->string('status');
        });
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->unsignedInteger('login_id');
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('events', function(Blueprint $table){
            $table->increments('id');
            $table->string('eventName');
            $table->date('eventStart');
            $table->date('eventEnd');
            $table->string('transactionId');
            $table->unsignedInteger('clientId');
            $table->foreign('clientId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('statusId');
            $table->foreign('statusId')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        DB::table('status')->insert(['status' => 'paid']);
        DB::table('status')->insert(['status' => 'pending']);
        DB::table('status')->insert(['status' => 'booked']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('users');
        Schema::drop('status');
        Schema::dropIfExists('logins');
    }
};
