<?php

namespace App\Filament\Resources\InvestorProfileResource\Pages;

use App\Filament\Resources\InvestorProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvestorProfile extends EditRecord
{
    protected static string $resource = InvestorProfileResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
