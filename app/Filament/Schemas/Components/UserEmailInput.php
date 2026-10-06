<?php

namespace App\Filament\Schemas\Components;

use Filament\Forms\Components\TextInput;

class UserEmailInput
{
    public static function make(): TextInput
    {
        return TextInput::make('email')
            ->label('Email address')
            ->email()
            ->required();
    }
}
