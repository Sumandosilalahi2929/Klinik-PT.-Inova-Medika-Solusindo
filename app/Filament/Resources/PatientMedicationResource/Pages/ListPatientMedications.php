<?php

namespace App\Filament\Resources\PatientMedicationResource\Pages;

use App\Filament\Resources\PatientMedicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientMedications extends ListRecords
{
    protected static string $resource = PatientMedicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
