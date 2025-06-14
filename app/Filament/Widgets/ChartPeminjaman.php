<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Peminjaman;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class ChartPeminjaman extends ChartWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Statistik Peminjaman Buku';
    protected static ?string $description = 'Statistik peminjaman buku per bulan';
    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $loansPerMonth = Peminjaman::select(
            DB::raw('MONTH(borrow_date) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $data = collect(range(1, 12))->map(function ($month) use ($loansPerMonth) {
            return $loansPerMonth->firstWhere('month', $month)->total ?? 0;
        })->toArray();

        $totalBooks = Book::count();
        $overdueLoans = Peminjaman::where('due_date', '<', now())->where('status', '!=', 'returned')->count();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Peminjaman Buku',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Jumlah Buku',
                    'data' => array_fill(0, 12, $totalBooks),
                    'backgroundColor' => 'rgba(255, 206, 86, 0.5)',
                    'borderColor' => 'rgba(255, 206, 86, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Jumlah Peminjaman Tenggang',
                    'data' => array_fill(0, 12, $overdueLoans),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
