<?php

namespace App\Filament\Resources\Audits\Tables;

use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AuditsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->label('Triggered at')
                    ->sortable(),
                TextColumn::make('triggeredBy.name')
                    ->searchable(),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('event')
                    ->formatStateUsing(fn (string $state): string => Str::headline($state))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('auditable_type')
                    ->label('Model')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('auditable_id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('started_at_ended_at')
                    ->default()
                    ->schema([
                        DatePicker::make('started_at')
                            ->closeOnDateSelection()
                            ->default(Carbon::now()->subdays(15)->startOfMonth())
                            ->displayFormat('d M Y')
                            ->label('Triggered date')
                            ->native(false)
                            ->suffix('at midnight'),
                        DatePicker::make('ended_at')
                            ->closeOnDateSelection()
                            ->default(Carbon::create('first day of next month')->setTime(0, 0))
                            ->displayFormat('d M Y')
                            ->label('Until')
                            ->native(false)
                            ->suffix('at midnight'),
                    ])
                    ->indicateUsing(function (array $data): ?string {
                        if ($data['started_at'] && $data['ended_at']) {
                            return 'From '.Carbon::parse($data['started_at'])->format('d M Y').' to '.Carbon::parse($data['ended_at'])->format('d M Y');
                        } elseif ($data['started_at']) {
                            return 'Started at '.Carbon::parse($data['started_at'])->format('d M Y');
                        } elseif ($data['ended_at']) {
                            return 'Ended at '.Carbon::parse($data['ended_at'])->format('d M Y');
                        }

                        return null;
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['started_at'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['ended_at'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                SelectFilter::make('triggeredBy')
                    ->multiple()
                    ->relationship('triggeredBy', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
