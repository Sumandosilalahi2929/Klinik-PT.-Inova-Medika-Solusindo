<?php

namespace App\Filament\Resources\ObatPasienResource\Pages;

use App\Filament\Resources\ObatPasienResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObatPasiens extends ListRecords
{
    protected static string $resource = ObatPasienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
