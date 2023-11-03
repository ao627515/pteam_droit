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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('short_desc')->nullable();
            $table->text('description');
            $table->integer('stock')->default(1);
            $table->string('image')->nullable();
            $table->foreignId('author_id')->constrained('users');
            $table->boolean('active')->default(true);
            $table->integer('status');
            $table->integer('prix');
            $table->timestamp('approuved_at')->nullable();
            $table->foreignId('approuved_by')->nullable()->constrained('users');
            $table->timestamp('declined_at')->nullable();
            $table->foreignId('declined_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
