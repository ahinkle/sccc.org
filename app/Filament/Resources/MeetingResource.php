<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingResource\Pages;
use App\Models\Meeting;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('meeting_topic_id')
                    ->label('Meeting Topic')
                    ->required()
                    ->relationship('meetingTopic', 'name'),

                DatePicker::make('meeting_date')
                    ->label('Meeting Date')
                    ->required()
                    ->minDate(now()->subYears(5))
                    ->maxDate(now()),

                FileUpload::make('file')
                    ->label('File / Upload')
                    ->directory('meetings')
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('meetingTopic.name')
                    ->label('Meeting Topic')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('meeting_date')
                    ->date('F j, Y')
                    ->label('Meeting Date')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lastUpdatedBy.name')
                    ->label('Last Updated By')
                    ->description(fn (Meeting $meeting) => $meeting->updated_at->format('F j, Y').' at '.$meeting->updated_at->format('g:i A')),
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
            ->defaultSort('meeting_date', 'desc');
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
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeeting::route('/create'),
            'edit' => Pages\EditMeeting::route('/{record}/edit'),
        ];
    }
}
