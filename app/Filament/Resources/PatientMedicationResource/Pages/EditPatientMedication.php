<?php

namespace App\Filament\Resources\PatientMedicationResource\Pages;

use App\Filament\Resources\PatientMedicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientMedication extends EditRecord
{
    protected static string $resource = PatientMedicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
