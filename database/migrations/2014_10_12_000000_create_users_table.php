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
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 20);
            $table->integer('nivel');
            $table->integer('equipe');
            $table->integer('status');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('deleted_by_name')->nullable();
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
