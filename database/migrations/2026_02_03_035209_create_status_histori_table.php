<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('histori_status', function (Blueprint $table) {
            $table->id();
            $table->forei('aspirasi_id')->constrained()->onDelete('cascade');
            $table->enum('old_status', ['pending', 'in_progress', 'resolved', 'rejected'])->nullable();
            $table->enum('new_status', ['pending', 'in_progress', 'resolved', 'rejected']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histori_status');
    }
};