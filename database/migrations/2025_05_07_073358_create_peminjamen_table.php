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
            $table->unsignedBigInteger('user_id'); // Kolom user_id
            $table->unsignedBigInteger('book_id')->default(1)->change();
            $table->date('borrow_date'); // Kolom borrow_date
            $table->date('return_date')->nullable(); // Kolom return_date
            $table->date('due_date'); // Kolom due_date
            $table->enum('status', ['returned', 'borrowed', 'booked', 'canceled'])->default('borrowed'); // Kolom status
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
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
