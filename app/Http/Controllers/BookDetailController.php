<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookDetailController extends Controller
{
    public function show($id)
    {
        $book = Book::with(['author', 'category', 'publisher'])->findOrFail($id);
        return view('book-detail', compact('book'));
    }
}
