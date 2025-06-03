<?php

namespace App\Filament\Resources\IntroductionRequestResource\Pages;

use App\Filament\Resources\IntroductionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIntroductionRequest extends EditRecord
{
    protected static string $resource = IntroductionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
