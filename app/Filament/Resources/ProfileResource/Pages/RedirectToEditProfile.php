<?php

namespace App\Filament\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use App\Models\Profile;
use Filament\Resources\Pages\Page;

class RedirectToEditProfile extends Page
{
    protected static string $resource = ProfileResource::class;

    public function mount(): void
    {
        $this->redirect(
            ProfileResource::getUrl('edit', ['record' => Profile::query()->value('id') ?? 1]),
            navigate: true,
        );
    }
}
