<?php

namespace App\Filament\Resources\KategoryBukuResource\Pages;

use App\Filament\Resources\KategoryBukuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoryBukus extends ListRecords
{
    protected static string $resource = KategoryBukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
