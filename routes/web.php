<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\BookList;
use App\Http\Controllers\BookDetailController;
use App\Http\Controllers\PeminjamanController;

//Route::get('/', BookList::class)->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/books/{id}', [BookDetailController::class, 'show'])->name('books.show');

Route::get('/peminjaman/create', function (\Illuminate\Http\Request $request) {
    $bookId = $request->query('book_id');
    // You can customize this to show a peminjaman form or redirect to a peminjaman page
    return 'Form peminjaman untuk buku ID: ' . $bookId;
})->name('peminjaman.create');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
});

require __DIR__.'/auth.php';
