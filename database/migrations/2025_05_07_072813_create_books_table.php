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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Kolom untuk judul buku
            $table->year('year'); // Kolom untuk tahun penerbitan
            $table->string('isbn')->unique(); // Kolom untuk ISBN dengan constraint unik
            $table->integer('stock'); // Kolom untuk jumlah stok buku
            $table->string('cover')->nullable(); // Kolom untuk cover buku (opsional)
            $table->unsignedBigInteger('publisher_id'); // Kolom publisher_id sebagai unsignedBigInteger
            $table->string('category'); // Kolom untuk kategori buku
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
