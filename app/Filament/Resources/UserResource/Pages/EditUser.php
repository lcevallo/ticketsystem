<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),

            Action::make('updatePassword')
                ->form([
                    TextInput::make('password')
                        ->password()
                        ->placeholder('Password')
                        ->required()
                        ->label('Password')
                        ->confirmed(),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->placeholder('Confirm Password')
                        ->required()
                        ->label('Confirm Password'),
                ])
                ->action(function (array $data, User $record):void {
                    $record->update([
                        'password' => $data['password']
                                ]);
                    Notification::make()
                        ->title('Password Updated')
                        ->success()
                        ->send();
                })


        ];
    }
}
