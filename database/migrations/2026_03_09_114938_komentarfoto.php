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
        Schema::create('komentarfoto', function(Blueprint $table){
            $table->id();
            $table->text('IsiKomentar');
            $table->date('TanggalKomentar');
            $table->unsignedBigInteger('FotoID');
            $table->foreign('FotoID')->references('id')->on('foto');
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
