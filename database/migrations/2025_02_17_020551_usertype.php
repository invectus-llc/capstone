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
        Schema::create('usertype', function(Blueprint $table){
            $table->increments('id');
            $table->string('usertype');
            $table->timestamps();
        });
        DB::table('usertype')->insert(['usertype'=>'admin', 'created_at'=>now(), 'updated_at'=>now()]);
        DB::table('usertype')->insert(['usertype'=>'client', 'created_at'=>now(), 'updated_at'=>now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usertype');
    }
};
