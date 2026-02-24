<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('username')->nullable()->unique(); // Untuk Admin
            $table->string('nis')->nullable()->unique();     // Untuk Siswa
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'siswa'])->default('siswa');
            $table->string('class')->nullable();  // Kelas siswa
            $table->string('major')->nullable();  // Jurusan siswa
            $table->boolean('is_active')->default(true);
            $table->boolean('must_change_password')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};