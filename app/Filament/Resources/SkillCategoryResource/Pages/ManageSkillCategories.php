<?php

namespace App\Filament\Resources\SkillCategoryResource\Pages;

use App\Filament\Resources\SkillCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSkillCategories extends ManageRecords
{
    protected static string $resource = SkillCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
