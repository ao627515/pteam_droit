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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('short_desc');
            $table->string('description');
            $table->string('image')->nullable();
            $table->foreignId('author_id')->constrained('users');
            $table->boolean('active')->default(false);
            $table->timestamp('approuved_at');
            $table->foreignId('approuved_by')->constrained('users');
            $table->foreignId('categorie_article_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
