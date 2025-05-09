<?php

namespace App\Filament\Resources\KategoryBukuResource\Pages;

use App\Filament\Resources\KategoryBukuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoryBuku extends EditRecord
{
    protected static string $resource = KategoryBukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
