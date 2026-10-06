<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Schemas\Components\UserEmailInput;
use App\Filament\Schemas\Components\UserNameInput;
use App\Filament\Schemas\Components\UserPasswordInput;
use App\Filament\Schemas\Components\UserRolesInput;
use Filament\Schemas\Schema;

class UserNewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                UserNameInput::make(),
                UserEmailInput::make(),
                UserPasswordInput::make(),
                UserRolesInput::make(),
            ]);
    }
}
