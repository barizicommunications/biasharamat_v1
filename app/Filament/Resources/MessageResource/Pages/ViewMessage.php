<?php

namespace App\Filament\Resources\MessageResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\MessageResource;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    protected static string $view = 'filament.resources.message-resource.pages.view-message';



    protected function getHeaderActions(): array
    {
        return [
            Action::make('Approve')
            ->label('Approve Message')
            ->action(fn ($record) => $record->update(['status' => 'approved']))
            ->color('success'),

        Action::make('Edit and Approve')
            ->label('Edit and Approve')
            ->form([
                Textarea::make('body')
                    ->label('Edit Message')
                    ->required(),
            ])
            ->action(function ($data, $record) {
                $record->update([
                    'body' => $data['body'],
                    'status' => 'approved',
                ]);
            })
            ->modalHeading('Edit Message')
            ->modalSubmitActionLabel('Approve'),
        ];
    }
}

