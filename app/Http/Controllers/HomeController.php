<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        // Mengambil parameter pencarian dari query string
        $search = $request->query('search');
        $category = $request->query('category');
        $author = $request->query('author');

        $oldInput = [
            'search' => $search,
            'category' => $category,
            'author' => $author,
        ];

        // Jika ada parameter pencarian, filter buku berdasarkan judul
        if ($search) {
            $books = Book::where('title', 'like', '%' . $search . '%')->latest()->paginate(8);
        } elseif ($category) {
            $books = Book::where('category_id', $category)->latest()->paginate(8);
        } elseif ($author) {
            $books = Book::where('author_id', $author)->latest()->paginate(8);
        } else{
            $books = Book::withCount([
                        'peminjamans'=>function($query){
                            $query->whereIn('status', ['borrowed', 'booked']);
                        }
                    ])
                    ->latest()->paginate(8); // Ambil buku terbaru dengan pagination
        }
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        return view('home', compact('books', 'categories', 'authors', 'oldInput'));
    }
}
