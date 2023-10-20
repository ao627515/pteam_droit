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
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('phone');
            $table->string('email');
            $table->string('logo')->nullable();
            // $table->string('domaine')->nullable();
            $table->string('description')->nullable();
            $table->string('short_description')->nullable();
            $table->boolean('active')->default(true);
            $table->foreignId('user_id');
            $table->foreignId('approuved_by')->nullable()->constrained('users');
            $table->timestamp('approuved_at')->nullable();
            $table->string('lib_doc_1')->nullable();
            $table->string('lib_doc_2')->nullable();
            $table->string('lib_doc_3')->nullable();
            $table->string('lib_doc_4')->nullable();
            $table->string('val_doc_1')->nullable();
            $table->string('val_doc_2')->nullable();
            $table->string('val_doc_3')->nullable();
            $table->string('val_doc_4')->nullable();
            $table->foreignId('domaine_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};
