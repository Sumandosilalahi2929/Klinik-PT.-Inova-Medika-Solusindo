<?php

namespace App\Filament\Resources\PatientActionsResource\Pages;

use App\Filament\Resources\PatientActionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientActions extends ListRecords
{
    protected static string $resource = PatientActionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
