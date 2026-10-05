<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Created At (UTC)')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Updated At (UTC)')
                    ->placeholder('-'),
            ]);
    }
}
