<?php

namespace App\Filament\Resources\TindakanMedisResource\Pages;

use App\Filament\Resources\TindakanMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTindakanMedis extends EditRecord
{
    protected static string $resource = TindakanMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
