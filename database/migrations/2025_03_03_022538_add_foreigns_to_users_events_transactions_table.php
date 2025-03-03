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
        //users table foreigns
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usertype_id')->references('id')->on('usertype')->onDelete('cascade')->onUpdate('cascade');
        });
        //events table foreigns
        Schema::table('events', function (Blueprint $table){
            $table->foreign('clientId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
        });
        //transactions table foreigns
        Schema::table('transactions', function (Blueprint $table){
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
        });
        //logs table foreigns
        Schema::table('logs', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['usertype_id']);
            $table->dropForeign(['login_id']);
        });
        Schema::table('events', function (Blueprint $table){
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['clientId']);
        });
        Schema::table('transactions', function (Blueprint $table){
            $table->dropForeign(['status_id']);
        });
        Schema::table('logs', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });
    }
};
