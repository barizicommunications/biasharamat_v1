<?php

namespace App\Filament\Resources\BusinessSellerResource\Pages;

use App\Filament\Resources\BusinessSellerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessSeller extends EditRecord
{
    protected static string $resource = BusinessSellerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
