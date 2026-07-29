<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms\Components\FileUpload;
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
            TextInput::make('name')->required(),
            TextInput::make('headline')->required(),
            Textarea::make('bio')->rows(6)->columnSpanFull(),
            TextInput::make('location'),
            TextInput::make('email')->email(),
            TextInput::make('phone'),
            FileUpload::make('photo_path')->image()->disk('public')->directory('portfolio')->columnSpanFull(),
            FileUpload::make('cv_path')->acceptedFileTypes(['application/pdf'])->disk('public')->directory('portfolio/cv')->downloadable(),
            Toggle::make('is_available')->label('Available for work'),
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
