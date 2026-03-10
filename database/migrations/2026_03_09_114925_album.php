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
        Schema::create('album', function(Blueprint $table){
            $table->id();
            $table->string('NamaAlbum');
            $table->text('Deskripsi');
            $table->date('TanggalDibuat');
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
