<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Book;
use App\Models\Peminjaman;

class StatsDashBoard extends BaseWidget
{
    protected static ?string $position = 'top';
    protected function getStats(): array
    {
        $totalBooks = Book::count();
        $activeLoans = Peminjaman::whereNull('returned_at')->count();
        $overdueLoans = Peminjaman::where('due_date', '<', now())->whereNull('returned_at')->count();

        return [
            Stat::make('Jumlah Buku', $totalBooks)
                ->description('Total books in the library')
                ->color('primary'),

            Stat::make('Jumlah Peminjaman Aktif', $activeLoans)
                ->description('Currently active loans')
                ->color('success'),

            Stat::make('Jumlah Peminjaman Tenggang', $overdueLoans)
                ->description('Overdue loans')
                ->color('danger'),
        ];
    }
}
