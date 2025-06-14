<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; // Pastikan ini di-import
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeminjamanRelationManager extends RelationManager
{
    protected static string $relationship = 'peminjaman';

    // Beri judul pada tabel relasi ini
    protected static ?string $title = 'Riwayat Peminjaman Buku';

    public function form(Form $form): Form
    {
        // Kita tidak akan membuat/mengedit peminjaman dari sini, jadi bisa disederhanakan
        return $form
            ->schema([
                // Dibiarkan kosong jika tidak ada form yang perlu ditampilkan
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id') // Atribut unik untuk identifikasi record
            ->columns([
                // Mengakses relasi dari peminjaman ke buku untuk mendapatkan judulnya
                TextColumn::make('books.title')
                    ->label('Judul Buku')
                    ->formatStateUsing(fn($state, $record) => $record->books->pluck('title')->join(', '))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('borrow_date') // Ganti dari 'tanggal_pinjam'
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_kembali')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('Belum dikembalikan'), // Teks jika tanggal kembali null

                TextColumn::make('status')
                    ->badge() // Tampilkan sebagai badge/label
                    ->color(fn($state) => match ($state) {
                        'dipinjam' => 'warning',
                        'dikembalikan' => 'success',
                        'terlambat' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                // Filter bisa ditambahkan di sini jika perlu
            ])
            ->headerActions([
                // Kita nonaktifkan tombol 'Create' karena transaksi peminjaman ada di menunya sendiri
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Kita nonaktifkan tombol 'Edit' dan 'Delete'
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
