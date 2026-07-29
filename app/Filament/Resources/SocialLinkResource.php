<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Models\SocialLink;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\Blade;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-link';
    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('platform')
                ->options(self::platformOptions())
                ->required()
                ->searchable()
                ->allowHtml()
                ->native(false)
                ->live()
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('icon', self::iconForPlatform($state))),
            TextInput::make('label')->required(),
            TextInput::make('url')->required(),
            Hidden::make('icon')->default('link'),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort_order')->columns([
            TextColumn::make('platform')->searchable(),
            TextColumn::make('label'),
            TextColumn::make('url')->limit(45),
            TextColumn::make('sort_order'),
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageSocialLinks::route('/')];
    }

    /**
     * @return array<string, string>
     */
    private static function platformOptions(): array
    {
        return collect([
            'linkedin' => ['LinkedIn', 'linkedin'],
            'instagram' => ['Instagram', 'instagram'],
            'facebook' => ['Facebook', 'facebook'],
            'github' => ['GitHub', 'github'],
            'youtube' => ['YouTube', 'youtube'],
            'whatsapp' => ['WhatsApp', 'whatsapp'],
            'email' => ['Email', 'mail'],
            'website' => ['Website / Web', 'public'],
            'link' => ['Link umum', 'link'],
        ])->mapWithKeys(fn (array $icon, string $value): array => [
            $value => sprintf('<span class="inline-flex" style="display:inline-flex;align-items:center;gap:8px;white-space:nowrap;height:20px;line-height:20px;vertical-align:middle" title="%s" aria-label="%s">%s<span style="display:inline;white-space:nowrap">%s</span></span>', $icon[0], $icon[0], self::platformIconMarkup($icon[1]), $icon[0]),
        ])->all();
    }

    private static function platformIconMarkup(string $icon): string
    {
        return match ($icon) {
            'linkedin' => Blade::render('<x-simpleicon-linkedin class="h-4 w-4" style="display:block;width:16px;height:16px;max-width:16px;max-height:16px;flex:none" />'),
            'instagram' => Blade::render('<x-simpleicon-instagram class="h-4 w-4" style="display:block;width:16px;height:16px;max-width:16px;max-height:16px;flex:none" />'),
            'facebook' => Blade::render('<x-simpleicon-facebook class="h-4 w-4" style="display:block;width:16px;height:16px;max-width:16px;max-height:16px;flex:none" />'),
            'github' => Blade::render('<x-simpleicon-github class="h-4 w-4" style="display:block;width:16px;height:16px;max-width:16px;max-height:16px;flex:none" />'),
            'youtube' => Blade::render('<x-simpleicon-youtube class="h-4 w-4" style="display:block;width:16px;height:16px;max-width:16px;max-height:16px;flex:none" />'),
            'whatsapp' => Blade::render('<x-simpleicon-whatsapp class="h-4 w-4" style="display:block;width:16px;height:16px;max-width:16px;max-height:16px;flex:none" />'),
            default => sprintf('<span class="material-symbols-outlined text-base" style="display:block;font-size:16px;line-height:16px;width:16px;height:16px">%s</span>', $icon),
        };
    }

    private static function iconForPlatform(?string $platform): string
    {
        return match (strtolower((string) $platform)) {
            'linkedin', 'instagram', 'facebook', 'github', 'youtube', 'whatsapp' => strtolower((string) $platform),
            'email' => 'mail',
            'website' => 'public',
            default => 'link',
        };
    }
}
