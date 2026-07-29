<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Profile';
    protected static ?string $modelLabel = 'Profile';
    protected static ?string $pluralModelLabel = 'Profile';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identitas')
                ->description('Informasi utama yang tampil pada halaman depan portfolio.')
                ->schema([
                    TextInput::make('name')->label('Nama')->required(),
                    TextInput::make('headline')->label('Headline')->required(),
                    Textarea::make('bio')->label('Bio')->rows(6)->helperText('Ceritakan ringkas tentang keahlian dan pengalaman utama Anda.')->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),
            Section::make('Kontak')
                ->description('Informasi yang digunakan pengunjung untuk menghubungi Anda.')
                ->schema([
                    TextInput::make('location')->label('Lokasi'),
                    TextInput::make('email')->label('Email')->email(),
                    TextInput::make('phone')->label('Nomor WhatsApp'),
                ])
                ->columns(2)
                ->columnSpanFull(),
            Section::make('Media Profile')
                ->description('Foto profile dan CV yang ditampilkan atau diunduh dari portfolio.')
                ->schema([
                    FileUpload::make('photo_path')
                        ->label('Foto Profile')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('220')
                        ->maxSize(5120)
                        ->disk('public')
                        ->directory('portfolio')
                        ->openable(),
                    FileUpload::make('cv_path')
                        ->label('CV')
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(10240)
                        ->disk('public')
                        ->directory('portfolio/cv')
                        ->downloadable()
                        ->openable(),
                ])
                ->columns(2)
                ->columnSpanFull(),
            Section::make('Status Profile')
                ->schema([
                    Toggle::make('is_available')->label('Available for work')->helperText('Tampilkan status siap menerima pekerjaan atau kolaborasi.'),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('headline')->searchable(),
            TextColumn::make('email'),
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\RedirectToEditProfile::route('/'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return static::getIndexUrl();
    }

    public static function getIndexUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null, bool $shouldGuessMissingParameters = false): string
    {
        return static::getUrl('edit', ['record' => Profile::query()->value('id') ?? 1, ...$parameters], $isAbsolute, $panel, $tenant, $shouldGuessMissingParameters);
    }
}
