<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillCategoryResource\Pages;
use App\Models\SkillCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SkillCategoryResource extends Resource
{
    protected static ?string $model = SkillCategory::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';
    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug((string) $state))),
            TextInput::make('slug')->required()->helperText('Dibuat otomatis dari nama kategori.'),
            TextInput::make('sort_order')->numeric()->default(0)->required(),
            Toggle::make('is_active')->default(true),
            Select::make('skills')
                ->relationship('skills', 'name')
                ->multiple()
                ->searchable()
                ->preload()
                ->label('Skill dalam kategori ini')
                ->helperText('Pilih beberapa skill. Urutan pilihan akan menjadi urutan tampil di portfolio.')
                ->createOptionForm([
                    TextInput::make('name')->required(),
                    TextInput::make('sort_order')->numeric()->default(0),
                    Toggle::make('is_active')->default(true),
                ])
                ->saveRelationshipsUsing(function (Select $component): void {
                    $category = $component->getRecord();
                    $skillIds = array_values(array_filter(array_map('intval', (array) $component->getState())));
                    $pivotData = [];

                    foreach ($skillIds as $index => $skillId) {
                        $pivotData[$skillId] = ['sort_order' => $index + 1];
                    }

                    $category->skills()->sync($pivotData);

                    $category->unsetRelation('skills');
                })
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('slug'),
            TextColumn::make('skills_count')->counts('skills'),
            TextColumn::make('sort_order'),
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ])->toolbarActions([
            \Filament\Actions\BulkActionGroup::make([
                \Filament\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageSkillCategories::route('/')];
    }
}
