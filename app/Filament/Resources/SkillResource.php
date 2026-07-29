<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-code-bracket';
    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('categories')
                ->relationship('categories', 'name')
                ->required()
                ->multiple()
                ->searchable()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
                    TextInput::make('slug')->required(),
                ])
                ->createOptionUsing(fn (array $data): int => \App\Models\SkillCategory::create($data)->getKey()),
            TextInput::make('name')->required(),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('categories.name')->label('Categories')->badge(),
            TextColumn::make('sort_order'),
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageSkills::route('/')];
    }
}
