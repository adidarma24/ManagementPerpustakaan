<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 ">
    <header class="bg-blue-700 text-white p-6 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{url('/')}}"><h1 class="text-2xl font-bold">Management Perpustakaan</h1></a>
            <nav>
                <a href="#" class="px-4 py-2 hover:underline">Home</a>
                <a href="#" class="px-4 py-2 hover:underline">Books</a>
                <a href="#" class="px-4 py-2 hover:underline">Members</a>
                <a href="#" class="px-4 py-2 hover:underline">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4 py-10">
        <div>
            <div class="container mx-auto py-10">
                <h1 class="text-4xl font-extrabold mb-10 text-center text-gray-800 dark:text-gray-100 tracking-wide drop-shadow">Daftar Buku Terbaru</h1>
                <form method="GET" action="{{route('home')}}" class="flex flex-col md:flex-row md:items-center md:space-x-4 justify-center mb-8 gap-4">
                    <input type="text" name="search" value="{{$oldInput['search']}}" wire:model.debounce.500ms="search" placeholder="Cari judul buku..." class="border rounded-full px-6 py-3 w-full md:w-1/3 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow">
                    <select name="category" wire:model="filterCategory" class="border rounded-full px-4 py-2 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $oldInput['category'] == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select name="author" wire:model="filterAuthor" class="border rounded-full px-4 py-2 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Penulis</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ $oldInput['author'] == $author->id ? 'author' : ''}}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">Cari</button>
                </form>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12">
                    @forelse ($books as $book)
                        <div class="bg-white dark:bg-gray-900 shadow-xl rounded-2xl overflow-hidden flex flex-col h-full border border-gray-100 dark:border-gray-800 hover:scale-105 hover:shadow-2xl transition-transform duration-300 group relative">
                            <div class="relative">
                                <img src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('images/default-book-cover.jpg') }}" alt="{{ $book->title }}" class="w-full h-56 object-cover object-center group-hover:opacity-80 transition">
                                <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-3 py-1 rounded-full shadow">Baru</span>
                            </div>
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2 truncate">{{ $book->title }}</h2>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1 italic">Penulis: <span class="font-medium text-gray-700 dark:text-gray-200">{{ optional($book->author)->name ?? 'autor' }}</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Tahun: <span class="font-medium text-gray-700 dark:text-gray-200">{{ $book->year }}</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Kategori: <span class="font-medium text-gray-700 dark:text-gray-200">{{ optional($book->category)->name ?? 'category' }}</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Penerbit: <span class="font-medium text-gray-700 dark:text-gray-200">{{ optional($book->publisher)->name ?? 'publisher' }}</span></p>
                                </div>
                                <div class="mt-6 flex justify-between items-center">
                                    <span class="text-lg font-bold text-blue-600 dark:text-blue-400">Stok: {{ $book->stock-$book->peminjamans_count }}</span>
                                    <a href="{{route("books.show", $book->id)}}" class="inline-block px-5 py-2 bg-blue-600 text-white text-sm font-semibold rounded-full shadow hover:bg-blue-700 transition">Pinjam</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 text-center text-gray-500 dark:text-gray-400">Tidak ada buku ditemukan.</div>
                    @endforelse
                </div>
                <div class="mt-10 flex justify-center">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
        </div>
    </main>
    <footer class="bg-gray-800 text-gray-200 text-center py-4">
        &copy; {{ date('Y') }} Management Perpustakaan. All rights reserved.
    </footer>
</body>
</html>