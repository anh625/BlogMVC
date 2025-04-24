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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id')->autoIncrement()->primary();
            $table->string('title',255);
            $table->string('description');
            $table->longText('content');
            $table->string('image');
            $table->string('user_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('view_counts')->default(0);
            $table->boolean('post_status')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
