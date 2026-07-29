<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Models\Certification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-check';
    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Training & Sertifikasi';
    protected static ?string $modelLabel = 'Training & Sertifikasi';
    protected static ?string $pluralModelLabel = 'Training & Sertifikasi';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('provider')->required(),
            Select::make('type')->options([
                'training' => 'Pelatihan',
                'certification' => 'Sertifikasi',
            ])->required()->default('certification'),
            DatePicker::make('completed_at')->label('Tanggal selesai/terbit'),
            TextInput::make('credential_id')->label('Nomor kredensial'),
            TextInput::make('verification_url')->label('URL verifikasi')->url(),
            Textarea::make('description')->rows(4)->columnSpanFull(),
            SpatieMediaLibraryFileUpload::make('cover')
                ->collection('cover')
                ->image()
                ->disk('public')
                ->imageEditor()
                ->helperText('Gambar preview yang tampil di card public.'),
            SpatieMediaLibraryFileUpload::make('certificate')
                ->collection('certificate')
                ->disk('public')
                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                ->maxSize(10240)
                ->downloadable()
                ->openable()
                ->columnSpanFull(),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->columns([
            \Filament\Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')->collection('cover')->label('Cover'),
            TextColumn::make('title')->searchable(),
            TextColumn::make('provider')->searchable(),
            TextColumn::make('type')->badge()->formatStateUsing(fn (string $state): string => $state === 'training' ? 'Pelatihan' : 'Sertifikasi'),
            TextColumn::make('completed_at')->date('M Y'),
            IconColumn::make('is_active')->boolean()->label('Active'),
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageCertifications::route('/')];
    }
}
