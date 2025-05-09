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
        Schema::create('publishers', function (Blueprint $table) {
            $table->bigIncrements('id'); // Menggunakan bigIncrements untuk id
            $table->string('name'); // Menambahkan kolom name
            $table->text('description')->nullable(); // Menambahkan kolom description (opsional)
            $table->string('logo')->nullable(); // Menambahkan kolom logo (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
