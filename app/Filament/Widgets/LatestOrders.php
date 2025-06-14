<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Peminjaman;
use Filament\Tables\Columns\TextColumn;

class LatestOrders extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Peminjaman::query()
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Peminjam')
                    ->searchable(),

                TextColumn::make('borrow_date')
                    ->label('Tanggal Pinjam')
                    ->date(),

                TextColumn::make('due_date')
                    ->label('Tanggal Jatuh Tempo')
                    ->date(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
            ]);
    }
}
