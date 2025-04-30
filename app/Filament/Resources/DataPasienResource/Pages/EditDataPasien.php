<?php

namespace App\Filament\Resources\DataPasienResource\Pages;

use App\Filament\Resources\DataPasienResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataPasien extends EditRecord
{
    protected static string $resource = DataPasienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
