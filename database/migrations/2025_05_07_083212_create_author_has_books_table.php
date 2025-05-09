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
        Schema::create('author_has_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id'); // Kolom author_id
            $table->foreign('author_id') // Definisi foreign key
                ->references('id')
                ->on('authors')
                ->onDelete('cascade');
            $table->unsignedBigInteger('book_id'); // Kolom book_id
            $table->foreign('book_id') // Definisi foreign key
                ->references('id')
                ->on('books')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_has_books');
    }
};
