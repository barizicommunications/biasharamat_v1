<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        return array_merge($data, [
            'slug' => \Str::slug($data['title']),
            'created_by' => auth()->user()->id,
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return BlogResource::getUrl();
    }
}
