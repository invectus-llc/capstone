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
            $table->timestamps();
        });
        Schema::create('usertype', function(Blueprint $table){
            $table->increments('id');
            $table->string('usertype');
            $table->timestamps();
        });
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->unsignedInteger('login_id');
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('usertype_id');
            $table->foreign('usertype_id')->references('id')->on('usertype')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('transactions', function(Blueprint $table){
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('amount');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('events', function(Blueprint $table){
            $table->increments('id');
            $table->string('eventName');
            $table->date('eventStart');
            $table->date('eventEnd');
            $table->unsignedInteger('clientId');
            $table->foreign('clientId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::table('status')->insert(['status' => 'paid', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'pending', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'booked', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('usertype')->insert(['usertype'=>'admin', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('usertype')->insert(['usertype'=>'client', 'created_at'=>now(), 'updated_at'=>now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::drop('transactions');
        Schema::dropIfExists('users');
        Schema::drop('usertype');
        Schema::drop('status');
        Schema::dropIfExists('logins');
    }
};
