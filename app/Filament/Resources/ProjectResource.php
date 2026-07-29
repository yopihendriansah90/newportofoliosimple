<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
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

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('slug')->required(),
            TextInput::make('summary')->columnSpanFull(),
            Textarea::make('description')->rows(5)->columnSpanFull(),
            SpatieMediaLibraryFileUpload::make('cover')->collection('cover')->image()->disk('public')->required(),
            SpatieMediaLibraryFileUpload::make('gallery')->collection('gallery')->multiple()->reorderable()->image()->disk('public')->maxFiles(12)->columnSpanFull(),
            Select::make('technologies')->relationship('technologies', 'name')->multiple()->searchable()->preload()->createOptionForm([
                TextInput::make('name')->required(),
            ])->columnSpanFull(),
            TextInput::make('demo_url')->url(),
            TextInput::make('repository_url')->url(),
            TextInput::make('year')->numeric()->minValue(2000)->maxValue(2100),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_featured')->label('Tampilkan di Proyek Pilihan'),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->columns([
            \Filament\Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')->collection('cover')->conversion('thumb')->label('Cover'),
            TextColumn::make('name')->searchable(),
            TextColumn::make('year'),
            TextColumn::make('technologies.name')->badge(),
            IconColumn::make('is_featured')->boolean()->label('Featured'),
            IconColumn::make('is_active')->boolean()->label('Active'),
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageProjects::route('/')];
    }
}
