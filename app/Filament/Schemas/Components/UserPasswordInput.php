<?php

namespace App\Filament\Schemas\Components;

use Filament\Forms\Components\TextInput;

class UserPasswordInput
{
    public static function make(): TextInput
    {
        return TextInput::make('password')
            ->password()
            ->required();
    }
}
