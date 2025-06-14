<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'year',
        'isbn',
        'stock',
        'cover',
        'publisher_id',
        'category_id',
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function peminjamans()
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_book');
    }
}
