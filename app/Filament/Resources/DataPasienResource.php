<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPasienResource\Pages;
use App\Models\Data_pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DataPasienResource extends Resource
{
    protected static ?string $model = Data_pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Data Pasien';
    protected static ?string $pluralLabel = 'Pasien';
    protected static ?string $navigationGroup = 'Manajemen Klinik';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Pasien';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama'),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(16)
                    ->unique()
                    ->label('NIK'),
                Forms\Components\Select::make('jenis_kelamin')
                    ->options([
                        'Laki-Laki' => 'Laki-Laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required()
                    ->label('Jenis Kelamin'),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required()
                    ->label('Tanggal Lahir'),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->label('Alamat'),
                Forms\Components\TextInput::make('nama_wilayah')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Wilayah'),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(15)
                    ->label('Nomor HP'),
                Forms\Components\TextInput::make('email')
                    ->nullable()
                    ->label('Email'),
                Forms\Components\TextInput::make('gol_darah')
                    ->nullable()
                    ->maxLength(3)
                    ->label('Golongan Darah'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('nik')
                    ->sortable()
                    ->searchable()
                    ->label('NIK'),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->sortable()
                    ->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->sortable()
                    ->date()
                    ->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('alamat')
                    ->limit(50)
                    ->label('Alamat'),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor HP'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relationships (if applicable)
        ];
    }
    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'dokter', 'pendaftaran']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPasiens::route('/'),
            'create' => Pages\CreateDataPasien::route('/create'),
            'edit' => Pages\EditDataPasien::route('/{record}/edit'),
        ];
    }
}
