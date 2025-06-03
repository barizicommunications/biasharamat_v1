<?php

namespace App\Filament\Resources\IntroductionRequestResource\Pages;

use App\Filament\Resources\IntroductionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditIntroductionRequest extends EditRecord
{
    protected static string $resource = IntroductionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete Introduction Request')
                ->modalDescription('Are you sure you want to delete this introduction request? This action cannot be undone.')
                ->modalSubmitActionLabel('Delete Request'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $originalStatus = $this->record->status;
        $originalPaymentStatus = $this->record->payment_status;

        // Auto-set reviewed_by and reviewed_at when status changes to approved/rejected
        if (in_array($data['status'], ['approved', 'rejected']) && !$this->record->reviewed_at) {
            $data['reviewed_by'] = auth()->id();
            $data['reviewed_at'] = now();
        }

        // Set introduction_sent_at when status is approved for the first time
        if ($data['status'] === 'approved' && $originalStatus !== 'approved' && !$this->record->introduction_sent_at) {
            $data['introduction_sent_at'] = now();
        }

        // Set payment_received_at when payment status changes to paid
        if ($data['payment_status'] === 'paid' && $originalPaymentStatus !== 'paid' && !$this->record->payment_received_at) {
            $data['payment_received_at'] = now();
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $changes = $this->record->getChanges();

        if (isset($changes['status'])) {
            $message = match ($this->record->status) {
                'approved' => 'Introduction request has been approved.',
                'rejected' => 'Introduction request has been rejected.',
                'completed' => 'Introduction request has been marked as completed.',
                default => 'Introduction request status has been updated.',
            };

            Notification::make()
                ->title('Status Updated')
                ->body($message)
                ->success()
                ->send();
        }

        if (isset($changes['payment_status'])) {
            $message = match ($this->record->payment_status) {
                'paid' => 'Payment has been marked as received.',
                'refunded' => 'Payment has been marked as refunded.',
                default => 'Payment status has been updated.',
            };

            Notification::make()
                ->title('Payment Status Updated')
                ->body($message)
                ->success()
                ->send();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->getRecord()]);
    }
}