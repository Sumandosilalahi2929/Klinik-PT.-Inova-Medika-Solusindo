<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPegawaiResource\Pages;
use App\Models\Data_pegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DataPegawaiResource extends Resource
{
    protected static ?string $model = Data_pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Pegawai';
    protected static ?string $pluralLabel = 'Pegawai';
    protected static ?string $modelLabel = 'Pegawai';
    protected static ?string $slug = 'pegawai';
    protected static ?string $navigationGroup = 'Manajemen Klinik';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Pegawai'),
                Forms\Components\TextInput::make('nip')
                    ->nullable()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->label('NIP'),
                Forms\Components\Select::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required()
                    ->label('Jenis Kelamin'),
                Forms\Components\TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255)
                    ->label('Jabatan'),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->tel()
                    ->maxLength(15)
                    ->label('Nomor HP'),
                Forms\Components\TextInput::make('email')
                    ->nullable()
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->label('Email'),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->label('Alamat'),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->nullable()
                    ->label('Tanggal Lahir'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nip')
                    ->sortable()
                    ->label('NIP'),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),
                Tables\Columns\TextColumn::make('jabatan'),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ])
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
            //
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPegawais::route('/'),
            'create' => Pages\CreateDataPegawai::route('/create'),
            'edit' => Pages\EditDataPegawai::route('/{record}/edit'),
        ];
    }
}
