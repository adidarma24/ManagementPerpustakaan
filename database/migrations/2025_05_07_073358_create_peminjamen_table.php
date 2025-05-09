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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade'); // Relasi ke tabel books
            $table->date('borrow_date'); // Tanggal peminjaman
            $table->date('return_date')->nullable(); // Tanggal pengembalian (opsional)
            $table->date('due_date'); // Tanggal jatuh tempo
            $table->enum('status', ['returned', 'borrowed', 'booked', 'canceled'])->default('borrowed'); // Status peminjaman
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
