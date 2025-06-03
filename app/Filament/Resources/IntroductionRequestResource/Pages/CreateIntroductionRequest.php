<?php

namespace App\Filament\Resources\IntroductionRequestResource\Pages;

use App\Filament\Resources\IntroductionRequestResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateIntroductionRequest extends CreateRecord
{
    protected static string $resource = IntroductionRequestResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set default values
        $data['requester_id'] = auth()->id();
        $data['service_fee'] = 2500.00;
        $data['status'] = 'pending';
        $data['payment_status'] = 'unpaid';

        return $data;
    }

    protected function afterCreate(): void
    {
        Notification::make()
            ->title('Introduction Request Created')
            ->body('The introduction request has been created successfully.')
            ->success()
            ->send();
    }
}