<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return array_merge($data, [
            'password' => \Hash::make($data['password']),
            'role' => 'ADMIN'
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return UserResource::getUrl();
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'User created';
    }
}
