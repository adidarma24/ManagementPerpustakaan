<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;

class BookList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCategory = '';
    public $filterAuthor = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingFilterCategory()
    {
        $this->resetPage();
    }
    public function updatingFilterAuthor()
    {
        $this->resetPage();
    }

    public function render()
    {
        $books = Book::with(['author', 'category', 'publisher'])
            ->when($this->filterCategory, function ($query) {
                $query->where('category_id', $this->filterCategory);
            })
            ->when($this->filterAuthor, function ($query) {
                $query->where('author_id', $this->filterAuthor);
            })
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderByDesc('created_at')
            ->paginate(8);

        $categories = \App\Models\Category::orderBy('name')->get();
        $authors = \App\Models\Author::orderBy('name')->get();

        return view('livewire.book-list', [
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }
}
