<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EditAccount extends BaseEditProfile
{
    public static function getLabel(): string
    {
        return 'Akun Saya';
    }

    public function defaultForm(Schema $schema): Schema
    {
        return parent::defaultForm($schema)->inlineLabel(false);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Akun')
                ->description('Nama dan email yang digunakan untuk mengakses panel admin.')
                ->schema([
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                ])
                ->columns(2)
                ->columnSpanFull(),
            Section::make('Keamanan Akun')
                ->description('Kosongkan password baru jika tidak ingin menggantinya.')
                ->schema([
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}
