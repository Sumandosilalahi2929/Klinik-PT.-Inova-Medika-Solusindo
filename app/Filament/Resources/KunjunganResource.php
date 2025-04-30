<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KunjunganResource\Pages;
use App\Models\Kunjungan;
use App\Models\Data_pasien;
use App\Models\Data_pegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KunjunganResource extends Resource
{
    protected static ?string $model = Kunjungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Data Kunjungan';
    protected static ?string $pluralLabel = 'Kunjungan';
    protected static ?string $modelLabel = 'Kunjungan';
    protected static ?string $slug = 'kunjungan';
    protected static ?string $navigationGroup = 'Transaksi Pasien';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('data_pasiens_id')
                    ->label('Nama Pasien')
                    ->relationship('Data_pasien', 'nama')
                    ->searchable()
                    ->options(
                        Data_pasien::query()->limit(100)->pluck('nama', 'id')
                    )
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('data_pegawais_id')
                    ->label('Nama Pegawai')
                    ->relationship('Data_pegawai', 'nama')
                    ->searchable()
                    ->options(
                        Data_pegawai::query()->limit(100)->pluck('nama', 'id')
                    )
                    ->preload()
                    ->required(),

                Forms\Components\DateTimePicker::make('tanggal_kunjungan')
                    ->label('Tanggal Kunjungan')
                    ->required(),

                Forms\Components\Select::make('tipe_kunjungan')
                    ->label('Tipe Kunjungan')
                    ->options([
                        'Kunjungan umum' => 'Kunjungan umum',
                        'Kunjungan laboratorium' => 'Kunjungan laboratorium',
                        'Kunjungan darurat (emergency)' => 'Kunjungan darurat (emergency)',
                        'Kunjungan spesialis' => 'Kunjungan spesialis',
                        'Follow-up setelah perawatan' => 'Follow-up setelah perawatan',
                        'Rehabilitasi fisik atau layanan lainnya' => 'Rehabilitasi fisik atau layanan lainnya',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('data_pasien.nama')
                    ->label('Pasien')
                    ->searchable(),


                Tables\Columns\TextColumn::make('data_pegawai.nama')
                    ->label('Pegawai')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal_kunjungan')
                    ->label('Tanggal Kunjungan')
                    ->dateTime('d M Y H:i'),

                Tables\Columns\TextColumn::make('tipe_kunjungan')
                    ->label('Tipe Kunjungan'),
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

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'dokter', 'pendaftaran']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('admin'); // cuma admin yang bisa create
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKunjungans::route('/'),
            'create' => Pages\CreateKunjungan::route('/create'),
            'edit' => Pages\EditKunjungan::route('/{record}/edit'),

        ];
    }
}
