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
            $table->bigInteger('contact_no');
            $table->unsignedInteger('login_id')->nullable();
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('usertype_id')->nullable();
            $table->foreign('usertype_id')->references('id')->on('usertype')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('transactions', function(Blueprint $table){
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('amount');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('events', function(Blueprint $table){
            $table->increments('id');
            $table->string('eventName');
            $table->date('eventStart');
            $table->date('eventEnd');
            $table->unsignedInteger('clientId')->nullable();
            $table->foreign('clientId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('transaction_id')->nullable();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
        Schema::create('logs', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('description');
            $table->timestamps();
        });
        DB::table('status')->insert(['status' => 'paid', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'pending', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('status')->insert(['status' => 'booked', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('usertype')->insert(['usertype'=>'admin', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('usertype')->insert(['usertype'=>'client', 'created_at'=>now(), 'updated_at'=>now()]);
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('events');
        Schema::drop('transactions');
        Schema::dropIfExists('users');
        Schema::drop('usertype');
        Schema::drop('status');
        Schema::dropIfExists('logins');
    }
};
