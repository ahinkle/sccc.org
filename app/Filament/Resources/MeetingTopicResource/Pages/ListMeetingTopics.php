<?php

namespace App\Filament\Resources\MeetingTopicResource\Pages;

use App\Filament\Resources\MeetingTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeetingTopics extends ListRecords
{
    protected static string $resource = MeetingTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
