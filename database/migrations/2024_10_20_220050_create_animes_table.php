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
            $table->unsignedBigInteger('episode_id');
            $table->string('episode');
            $table->foreign('anime_id')->references('id')->on('animes')->onDelete('cascade');
        });
                Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('text', 500);
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'posts_user_id'
            );
            $table->unsignedBigInteger('episode_id')->nullable();
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('cascade'); 
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animes');
        Schema::dropIfExists('episodes');
    }
};
