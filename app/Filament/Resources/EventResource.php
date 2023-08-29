<?php

namespace App\Filament\Resources;

use App\Enums\EventFrequency;
use App\Enums\State;
use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Event Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->autofocus()
                            ->required()
                            ->label('Event Name'),
                        Forms\Components\FileUpload::make('image')
                            ->required()
                            ->label('Event Image')
                            ->image()
                            ->imageEditor(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->label('Event Description')
                            ->columnSpan(2),
                    ]),

                Forms\Components\Fieldset::make('Event Time')
                    ->schema([
                        Forms\Components\DateTimePicker::make('starts_at')
                            ->required()
                            ->seconds(false)
                            ->label('Event Start')
                            ->afterOrEqual('today'),
                        Forms\Components\DateTimePicker::make('ends_at')
                            ->label('Event End')
                            ->seconds(false)
                            ->helperText('Optional. Add only if you want to specify an end time on the event page.')
                            ->nullable()
                            ->afterOrEqual('starts_at'),
                        Forms\Components\Select::make('repeat_frequency')
                            ->label('Recurring Schedule')
                            ->options(EventFrequency::class)
                            ->placeholder('Event does not repeat')
                            ->helperText('Automatically creates recurring events on the event page. For example, if you select "Weekly", the event will be created on the event page every week. Use the "End Date" field to specify when the recurring events should stop being created.'),
                    ]),

                Forms\Components\Fieldset::make('Event Location')
                    ->schema([
                        Forms\Components\TextInput::make('location')
                            ->required()
                            ->label('Event Location')
                            ->default('Santa Claus Christian Church')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->label('Event Address')
                            ->default('351 N Holiday Blvd')
                            ->columnSpan(2),
                        Forms\Components\Grid::make()
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('city')
                                    ->required()
                                    ->label('Event City')
                                    ->default('Santa Claus'),
                                Forms\Components\Select::make('state')
                                    ->required()
                                    ->label('Event State')
                                    ->options(State::class)
                                    ->default(State::INDIANA),
                                Forms\Components\TextInput::make('zip_code')
                                    ->required()
                                    ->label('Event Zip Code')
                                    ->default('47579'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Event Start')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->placeholder('No end time')
                    ->label('Event End')
                    ->dateTime('M j, Y g:i A'),

                Tables\Columns\TextColumn::make('repeat_frequency')
                    ->label('Repeats?'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('duplicate')
                    ->form([
                        Forms\Components\Fieldset::make('Event Time')
                            ->schema([
                                Forms\Components\DateTimePicker::make('starts_at')
                                    ->required()
                                    ->seconds(false)
                                    ->label('Event Start')
                                    ->afterOrEqual('today'),
                                Forms\Components\DateTimePicker::make('ends_at')
                                    ->label('Event End')
                                    ->seconds(false)
                                    ->helperText('Optional. Add only if you want to specify an end time on the event page.')
                                    ->nullable()
                                    ->afterOrEqual('starts_at'),
                                Forms\Components\Select::make('repeat_frequency')
                                    ->label('Recurring Schedule')
                                    ->options(EventFrequency::class)
                                    ->placeholder('Event does not repeat')
                                    ->helperText('Automatically creates recurring events on the event page. For example, if you select "Weekly", the event will be created on the event page every week. Use the "End Date" field to specify when the recurring events should stop being created.'),
                            ]),
                    ])
                    ->fillForm(function (Event $event) {
                        return [
                            'starts_at' => $event->starts_at,
                            'ends_at' => $event->ends_at,
                            'repeat_frequency' => $event->repeat_frequency,
                        ];
                    })
                    ->label('Duplicate')
                    ->modalIcon('heroicon-o-square-2-stack')
                    ->icon('heroicon-o-square-2-stack')
                    ->action(function (Event $event, $data) {
                        $event->replicate()->fill([
                            'starts_at' => $data['starts_at'],
                            'ends_at' => $data['ends_at'],
                            'repeat_frequency' => $data['repeat_frequency'],
                        ])->save();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
