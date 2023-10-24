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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type_compte');
            $table->integer('status')->nullable();
            $table->string('role')->default('utilisateur')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('approuved_by')->nullable()->constrained('users');
            $table->timestamp('approuved_at')->nullable();
            $table->foreignId('declined_by')->nullable()->constrained('users');
            $table->timestamp('declined_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
