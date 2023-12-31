<?php

namespace App\Filament\Resources;

use App\Enums\State;
use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
                            ->placeholder('e.g., Family Fun Weekend')
                            ->required()
                            ->label('Event Name'),
                        Forms\Components\FileUpload::make('image')
                            ->label('Event Image')
                            ->helperText('Recommend 600x600 -- Do not upload anything under copyright law.')
                            ->image()
                            ->imageEditor(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->label('Event Description')
                            ->placeholder('This event will be for ages X to X, includes fun for the entire family, childcare included.. etc.')
                            ->helperText('Please do not include links in the description - they will not be clickable. Use the "Event Link" field instead.')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('more_information')
                            ->label('Questions? (Contact Info)')
                            ->placeholder('John Doe at john@doe.com')
                            ->helperText('Optional. Add only if you want to display "questions" area within the event page.')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('link')
                            ->label('Event Link')
                            ->placeholder('e.g. https://www.google.com')
                            ->helperText('Optional. The link to the event page.')
                            ->url()
                            ->live(),
                        Forms\Components\TextInput::make('button_link_text')
                            ->label('Event Link Text')
                            ->placeholder('e.g. Sign-up')
                            ->default('Sign-up')
                            ->hidden(fn (Get $get): bool => ! $get('link')),
                    ]),

                Forms\Components\Fieldset::make('Event Time')
                    ->schema([
                        Forms\Components\DateTimePicker::make('starts_at')
                            ->required()
                            ->seconds(false)
                            ->helperText('Set the time as midnight if the event does not have a specific start time.')
                            ->default(now()->startOfDay())
                            ->label('Event Start')
                            ->afterOrEqual('today'),
                        Forms\Components\DateTimePicker::make('ends_at')
                            ->label('Event End')
                            ->seconds(false)
                            ->helperText('Optional. Add only if you want to specify an end time on the event page.')
                            ->nullable()
                            ->afterOrEqual('starts_at'),
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
                                    ->default(State::IN),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('duplicate')
                        ->form([
                            Forms\Components\Fieldset::make('Event Information')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->autofocus()
                                        ->placeholder('e.g., Family Fun Weekend')
                                        ->required()
                                        ->label('Event Name'),
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
                                ]),
                        ])
                        ->fillForm(function (Event $event) {
                            return [
                                'name' => $event->name,
                                'starts_at' => $event->starts_at,
                                'ends_at' => $event->ends_at,
                            ];
                        })
                        ->label('Duplicate')
                        ->modalIcon('heroicon-o-square-2-stack')
                        ->icon('heroicon-o-square-2-stack')
                        ->action(function (Event $event, $data) {
                            $event->replicate()->fill([
                                'name' => $data['name'],
                                'starts_at' => $data['starts_at'],
                                'ends_at' => $data['ends_at'],
                            ])->save();
                        }),
                ]),
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
