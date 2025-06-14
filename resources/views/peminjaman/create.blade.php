@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-950 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Pinjam Buku</h2>
        <form method="POST" action="{{ route('peminjaman.store') }}">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Judul Buku</label>
                <div class="p-2 bg-gray-100 dark:bg-gray-800 rounded">{{ $book->title }}</div>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">Konfirmasi Pinjam</button>
        </form>
    </div>
</div>
@endsection
