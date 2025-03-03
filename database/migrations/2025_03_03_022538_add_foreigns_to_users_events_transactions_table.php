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
        Schema::table('users_events_transactions', function (Blueprint $table) {
            //users table foreigns
            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('usertype_id')->references('id')->on('usertype')->onDelete('cascade')->onUpdate('cascade');

            //events table foreigns
            $table->foreign('clientId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');

            //transactions table foreigns
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');

            //logs table foreigns
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_events_transactions', function (Blueprint $table) {
            //
        });
    }
};
