<?php

namespace App\Filament\Resources\TindakanMedisResource\Pages;

use App\Filament\Resources\TindakanMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTindakanMedis extends ListRecords
{
    protected static string $resource = TindakanMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
