<?php

namespace App\Filament\Resources\ObatObatanResource\Pages;

use App\Filament\Resources\ObatObatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObatObatan extends EditRecord
{
    protected static string $resource = ObatObatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
