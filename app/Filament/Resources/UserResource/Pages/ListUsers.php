<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\UserRegistrationMail;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Mail;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create User'),

            Action::make('registration_email')
                ->label('Send Registration Email')
                ->form([
                    TextInput::make('email')
                        ->required()
                        ->maxLength(255)
                        ->email()
                        ->unique(),
                ])
                ->action(function (array $data) {
                    Mail::to($data['email'])->send(new UserRegistrationMail($data['email']));
                }),
        ];
    }
}
