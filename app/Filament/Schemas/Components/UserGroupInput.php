<?php

namespace App\Filament\Schemas\Components;

use Filament\Forms\Components\Select;

class UserGroupInput
{
    public static function make(): Select
    {
        return Select::make('group_id')
            ->preload()
            ->relationship('group', 'name')
            ->searchable();
    }
}
