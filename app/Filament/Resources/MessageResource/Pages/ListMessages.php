<?php

namespace App\Filament\Resources\MessageResource\Pages;

use Filament\Actions;
use App\Models\Message;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MessageResource;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
