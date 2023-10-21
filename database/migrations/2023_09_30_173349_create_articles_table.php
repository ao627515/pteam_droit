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
            $table->string('description');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->longText('contenu');
            $table->foreignId('author_id')->constrained('users');
            $table->boolean('active')->default(true);
            $table->integer('status');
            $table->timestamp('approuved_at')->nullable();
            $table->foreignId('approuved_by')->nullable()->constrained('users');
            $table->timestamp('declined_at')->nullable();
            $table->foreignId('declined_by')->nullable()->constrained('users');
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
