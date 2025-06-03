<?php

namespace App\Filament\Resources\IntroductionRequestResource\Pages;

use App\Filament\Resources\IntroductionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIntroductionRequests extends ListRecords
{
    protected static string $resource = IntroductionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
