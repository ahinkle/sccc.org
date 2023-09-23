<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingTopicResource\Pages;
use App\Models\MeetingTopic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class MeetingTopicResource extends Resource
{
    protected static ?string $model = MeetingTopic::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(MeetingTopic::class, 'name')
                    ->placeholder('E.g., Administration Council')
                    ->helperText('The name of the meeting topic. This is publicly visible.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->description(fn (MeetingTopic $meetingTopic) => $meetingTopic->slug)
                    ->sortable(),
                TextColumn::make('lastUpdatedBy.name')
                    ->label('Last Updated By')
                    ->description(fn (MeetingTopic $meetingTopic) => Carbon::parse($meetingTopic->updated_at)->format('F j, Y').' at '.Carbon::parse($meetingTopic->updated_at)->format('g:i A')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeetingTopics::route('/'),
            'create' => Pages\CreateMeetingTopic::route('/create'),
            'edit' => Pages\EditMeetingTopic::route('/{record}/edit'),
        ];
    }
}
