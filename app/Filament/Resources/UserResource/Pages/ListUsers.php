<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\UserRegistrationMail;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Mail;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('registration_email')
                ->label('Send Registration Email')
                ->form([
                    TextInput::make('registration_email')
                        ->required()
                        ->maxLength(255)
                        ->email()
                        ->unique(),
                ])
                ->action(function (array $data) {
                    Mail::to($data['registration_email'])->send(new UserRegistrationMail($data['registration_email']));
                }),
        ];
    }
}
