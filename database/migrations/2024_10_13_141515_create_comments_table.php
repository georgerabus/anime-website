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
            $table->integer('parent_id')->nullable(); // Optional: if NULL is needed, use nullable()
            $table->longText('text');
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'posts_user_id'
            );
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
