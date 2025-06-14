<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'due_date',
        'status',
    ];

    /**
     * Relasi ke model Member.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Book.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'peminjaman_book');
    }

    /**
     * Relasi ke model Book.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
