<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Unsigned BIGINT by default
            $table->unsignedBigInteger('parent_id')->nullable(); // Optional: if NULL is needed, use nullable()
            $table->string('text', 500);
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'posts_user_id'
            );
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
