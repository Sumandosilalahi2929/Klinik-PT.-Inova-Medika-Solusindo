<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Visit;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;
    protected static ?string $navigationLabel = 'Kunjungan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Form untuk CRUD Visit
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patients_id')
                    ->label('Pasien')
                    ->required()
                    ->options(function () {
                        return \App\Models\Patient::all()->pluck('name', 'id'); // mengambil data pasien dari model Patient
                    })
                    ->searchable(),
                Forms\Components\Select::make('employees_id')
                    ->label('Pegawai')
                    ->required()
                    ->options(function () {
                        return \App\Models\Employee::all()->pluck('name', 'id'); // mengambil data pegawai dari model Employee
                    })
                    ->searchable(),
                Forms\Components\DateTimePicker::make('date_visit')
                    ->label('Tanggal Kunjungan')
                    ->required(),
                Forms\Components\Select::make('type_visit')
                    ->label('Jenis Kunjungan')
                    ->required()
                    ->options([
                        'umum' => 'Umum',
                        'laboratorium' => 'Laboratorium',
                    ]),
            ]);
    }

    // Menampilkan data di tabel
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patients_id')
                    ->label('Pasien')
                    ->getStateUsing(fn($record) => $record->patient->name) // Menampilkan nama pasien
                    ->sortable(),
                Tables\Columns\TextColumn::make('employees_id')
                    ->label('Pegawai')
                    ->getStateUsing(fn($record) => $record->employee->name) // Menampilkan nama pegawai
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_visit')
                    ->label('Tanggal Kunjungan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type_visit')
                    ->label('Jenis Kunjungan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([/* filter jika ada */])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }
}
