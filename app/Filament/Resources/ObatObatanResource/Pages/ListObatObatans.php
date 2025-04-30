<?php

namespace App\Filament\Resources\ObatObatanResource\Pages;

use App\Filament\Resources\ObatObatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObatObatans extends ListRecords
{
    protected static string $resource = ObatObatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
