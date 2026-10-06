<?php

namespace App\Filament\Schemas\Components;

use Filament\Forms\Components\TextInput;

class UserNameInput
{
    public static function make(): TextInput
    {
        return TextInput::make('name')
            ->required();
    }
}
