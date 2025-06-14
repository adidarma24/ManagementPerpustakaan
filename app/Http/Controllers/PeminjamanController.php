<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function create(Request $request)
    {
        $bookId = $request->query('book_id');
        $book = Book::findOrFail($bookId);
        return view('peminjaman.create', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        $peminjaman = new Peminjaman();
        $peminjaman->book_id = $request->book_id;
        $peminjaman->user_id = Auth::id();
        $peminjaman->borrow_date = now();
        $peminjaman->status = 'borrowed';
        $peminjaman->save();
        return redirect()->route('books.show', $request->book_id)->with('success', 'Buku berhasil dipinjam!');
    }
}
