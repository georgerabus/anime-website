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
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('photo')->nullable();
        });

        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anime_id'); 
            $table->string('episode');
            $table->foreign('anime_id')->references('id')->on('animes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animes');
        Schema::dropIfExists('episodes');
    }
};
