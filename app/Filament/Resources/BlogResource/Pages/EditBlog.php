<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlog extends EditRecord
{
    protected static string $resource = BlogResource::class;

    public function mutateFormDataBeforeUpdate(array $data): array
    {
        return array_merge($data, [
            'slug' => \Str::slug($data['title']),
            'updated_by' => auth()->user()->id,
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->icon('icon-trash')
                ->successNotificationTitle(fn() => 'Blog deleted!')
                ->failureNotificationTitle('There was a problem deleting this blog. Please try again.')
                ->requiresConfirmation()
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Blog saved!';
    }

    protected ?string $subheading = 'Edit the blog by updating the form below.';

    protected function getRedirectUrl(): ?string
    {
        return BlogResource::getUrl();
    }
}
