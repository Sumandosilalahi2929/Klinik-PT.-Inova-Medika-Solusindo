<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientMedicationResource\Pages;
use App\Models\Patient_medication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientMedicationResource extends Resource
{
    protected static ?string $model = Patient_medication::class;
    protected static ?string $navigationLabel = 'Obat Pasien';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('visits_id') // Pilih pasien
                    ->label('Tanggal Kunjungan')
                    ->required()
                    ->options(function () {
                        return \App\Models\Visit::all()->pluck('date_visit', 'id');
                    })
                    ->searchable(),

                Forms\Components\Select::make('patients_id') // Pilih pasien
                    ->label('Pasien')
                    ->required()
                    ->options(function () {
                        return \App\Models\Patient::all()->pluck('name', 'id');
                    })
                    ->searchable(),

                Forms\Components\Select::make('drugs_id')
                    ->label('Obat pasien')
                    ->required()
                    ->options(function () {
                        return \App\Models\Drug::all()->pluck('name_drugs', 'id');
                    })
                    ->searchable(),

                Forms\Components\Textarea::make('dosage')
                    ->label('Dosis')
                    ->required()
                    ->rows(2),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Berakhir')
                    ->required(),

                Forms\Components\TextInput::make('notes')
                    ->label('Catatan')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visit')
                    ->label('Tanggal Kunjungan')
                    ->getStateUsing(fn($record) => $record->visit->date_visit)
                    ->sortable(),

                Tables\Columns\TextColumn::make('patients_id')
                    ->label('Pasien')
                    ->getStateUsing(fn($record) => $record->patient->name)
                    ->sortable(),

                Tables\Columns\TextColumn::make('drugs_id')
                    ->label('Obat Pasien')
                    ->getStateUsing(fn($record) => $record->drug->name_drugs)
                    ->sortable(),

                Tables\Columns\TextColumn::make('dosage')
                    ->label('Dosis')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Catatan')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientMedications::route('/'),
            'create' => Pages\CreatePatientMedication::route('/create'),
            'edit' => Pages\EditPatientMedication::route('/{record}/edit'),
        ];
    }
}
