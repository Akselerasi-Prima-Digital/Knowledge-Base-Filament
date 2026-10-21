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
        Schema::create('article_tags', function (Blueprint $table) {
            $table->foreignUuid('article_id')->references('uuid')->on('articles')->cascadeOnDelete();
            $table->foreignUuid('tag_id')->references('uuid')->on('tags')->restrictOnDelete();
            $table->primary(['article_id', 'tag_id']);
            $table->timestamps();
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
