<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku - {{ $book->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Detail Buku</h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
                <img src="{{ asset('storage/' . $book->cover) }}" alt="Kover Buku" class="rounded-md w-full object-cover">
            </div>

            <div class="md:w-2/3">
                <h3 class="text-xl font-bold mb-2">{{ $book->title }}</h3>
                <p><span class="font-semibold">Penulis:</span> {{ $book->author->name ?? '-' }}</p>
                <p><span class="font-semibold">Tahun Terbit:</span> {{ $book->year ?? '-' }}</p>
                <p><span class="font-semibold">Kategori:</span> {{ $book->category->name ?? '-' }}</p>
                <p><span class="font-semibold">Penerbit:</span> {{ $book->publisher->name ?? '-' }}</p>
                <p><span class="font-semibold">ISBN:</span> {{ $book->isbn ?? '-' }}</p>
                <p><span class="font-semibold">Stok:</span> {{ $book->stock ?? '0' }}</p>

                <div class="mt-6 flex gap-4">
                    <a href="{{ $book->stock > 0 ? route('peminjaman.create', ['book_id' => $book->id]) : '#' }}"
                       class="px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-50 disabled:cursor-not-allowed
                       {{ $book->stock < 1 ? 'pointer-events-none opacity-50' : '' }}">
                        Pinjam Buku
                    </a>

                    <a href="{{ route("home") }}"
                       class="px-6 py-2 bg-gray-300 text-black rounded-md shadow hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
</body>
</html>
