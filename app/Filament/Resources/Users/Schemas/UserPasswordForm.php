<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Schemas\Components\UserPasswordInput;
use Filament\Schemas\Schema;

class UserPasswordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                UserPasswordInput::make(),
            ]);
    }
}
