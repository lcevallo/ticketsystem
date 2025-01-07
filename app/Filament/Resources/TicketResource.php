<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TicketResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Filament\Resources\TicketResource\RelationManagers\CategoriesRelationManager;
use Filament\Tables\Filters\SelectFilter;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->autofocus()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('priority')
                    ->options(self::$model::PRIORITY)
                    ->required(),
                Forms\Components\Select::make('status')
                ->options(self::$model::STATUS)
                ->required(),

                // Forms\Components\Select::make('assigned_by')
                //     ->relationship('assignedBy', 'name')
                //     ->required()
                //     ,
                // Forms\Components\Select::make('assigned_to')
                //     ->relationship('assignedTo', 'name')
                //     ->required(),

                Forms\Components\Select::make('assigned_to')
                    ->options(
                        User::whereHas('roles',function(Builder $query){
                            $query->where('title','Agent');
                        })->pluck('name','id')->toArray()
                    )
                    ->required(),

                Forms\Components\RichEditor::make('comment')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->description(fn (Ticket $ticket) => $ticket->description)
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority')
                   ->badge(fn (Ticket $ticket) => $ticket->priority)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignedBy.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    // ->toggleable(isToggledHiddenByDefault: true)
                    ,
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextInputColumn::make('comment')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('priority')
                    ->options(self::$model::PRIORITY)
                    ->label('Priority')
                    ->placeholder('Filter by Priority')
                    ,
                SelectFilter::make('status')
                    ->options(self::$model::STATUS)
                    ->label('Status')
                    ->placeholder('Filter by Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
