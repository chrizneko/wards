<?php

namespace App\Filament\Resources\Audits\Schemas;

use App\Services\AuditService;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Icon;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuditInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(5)
                            ->columnSpanFull()
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Triggered at')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('-'),
                                TextEntry::make('triggeredBy.name')
                                    ->label('Triggered by')
                                    ->placeholder('-'),
                                TextEntry::make('event')
                                    ->formatStateUsing(fn (string $state): string => Str::headline($state)),
                                TextEntry::make('auditable_type')
                                    ->label('Model'),
                                TextEntry::make('auditable_id')
                                    ->label('ID')
                                    ->numeric(),
                            ]),
                    ]),
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Flex::make([
                            KeyValueEntry::make('old_values')
                                ->hiddenLabel()
                                ->keyLabel('Field')
                                ->valueLabel('Old values')
                                ->state(fn (?Model $record): array => AuditService::getValuesForInfolist(record: $record, type: 'old'))
                                ->placeholder('-'),
                            Icon::make(Heroicon::ArrowLongRight)
                                ->grow(false),
                            KeyValueEntry::make('new_values')
                                ->hiddenLabel()
                                ->keyLabel('Field')
                                ->valueLabel('New values')
                                ->state(fn (?Model $record): array => AuditService::getValuesForInfolist(record: $record, type: 'new'))
                                ->placeholder('-'),
                        ])->from('md'),

                    ]),
            ]);
    }
}
