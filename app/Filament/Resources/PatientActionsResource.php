<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientActionsResource\Pages;
use App\Models\Patient_actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder; // Tambahkan import untuk Builder

class PatientActionsResource extends Resource
{
    protected static ?string $model = Patient_actions::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('patient_id')
                    ->label('ID Pasien')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('action_type')
                    ->label('Tipe Tindakan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('action_description')
                    ->label('Deskripsi Tindakan')
                    ->maxLength(500),
                Forms\Components\DatePicker::make('action_date')
                    ->label('Tanggal Tindakan')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->label('Status')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient_id')
                    ->label('ID Pasien')
                    ->sortable(),
                Tables\Columns\TextColumn::make('action_type')
                    ->label('Tipe Tindakan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('action_description')
                    ->label('Deskripsi Tindakan')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('action_date')
                    ->label('Tanggal Tindakan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'completed' => 'Selesai',
                        'pending' => 'Tertunda',
                        'in_progress' => 'Dalam Proses',
                    ])
                    // Gunakan builder Eloquent yang benar
                    ->query(fn(Builder $query, array $data) => $query->where('status', $data['value'])),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Jika ada relasi, tambahkan di sini
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientActions::route('/'),
            'create' => Pages\CreatePatientActions::route('/create'),
            'edit' => Pages\EditPatientActions::route('/{record}/edit'),
        ];
    }
}
