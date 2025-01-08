<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTickets extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                auth()->user()->hasRole('Agent') ? Ticket::where('assigned_to',auth()->id()) : Ticket::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->description(fn (Ticket $ticket) => $ticket->description)
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority')
                   ->badge(fn (Ticket $ticket) => $ticket->priority)
                    ->color(fn (string $state): string => match ($state) {
                        'low' => 'gray',
                        'medium' => 'warning',
                        'high' => 'danger',
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable()
                   ,
                   Tables\Columns\TextColumn::make('assignedTo.name')
                   ->numeric()
                   ->sortable(),
                   Tables\Columns\TextColumn::make('assignedBy.name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextInputColumn::make('comment')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()


            ]);
    }
}
