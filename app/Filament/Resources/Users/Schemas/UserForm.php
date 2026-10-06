<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Schemas\Components\UserEmailInput;
use App\Filament\Schemas\Components\UserNameInput;
use App\Filament\Schemas\Components\UserRolesInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                UserNameInput::make(),
                UserEmailInput::make(),
                UserRolesInput::make(),
            ]);
    }
}
