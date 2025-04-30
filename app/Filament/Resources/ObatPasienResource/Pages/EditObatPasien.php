<?php

namespace App\Filament\Resources\ObatPasienResource\Pages;

use App\Filament\Resources\ObatPasienResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObatPasien extends EditRecord
{
    protected static string $resource = ObatPasienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
