<?php

namespace App\Filament\Schemas\Components;

use Filament\Forms\Components\Select;

class UserRolesInput
{
    public static function make(): Select
    {
        return Select::make('roles')
            ->relationship('roles', 'name')
            ->multiple()
            ->preload()
            ->searchable();
    }
}
