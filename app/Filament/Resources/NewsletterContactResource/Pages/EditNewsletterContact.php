<?php

namespace App\Filament\Resources\NewsletterContactResource\Pages;

use App\Filament\Resources\NewsletterContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsletterContact extends EditRecord
{
    protected static string $resource = NewsletterContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
