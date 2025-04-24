<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id')->primary();
            $table->string('title', 255);
            $table->string('description');
            $table->longText('content');
            $table->string('image');

            $table->uuid('user_id');
            $table->unsignedBigInteger('category_id');

            $table->boolean('highlight_post')->default(false);
            $table->boolean('post_status')->default(true);
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('category_id')->references('category_id')->on('categories');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
