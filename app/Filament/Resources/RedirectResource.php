<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedirectResource\Pages;
use App\Models\Redirect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-top-right-on-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('from')
                    ->autofocus()
                    ->required()
                    ->placeholder('/old-url'),
                Forms\Components\TextInput::make('to')
                    ->required()
                    ->placeholder('/new-url'),
                Forms\Components\Select::make('code')
                    ->required()
                    ->options([
                        '301' => '301 - Permanent',
                        '302' => '302 - Temporary',
                    ])
                    ->default('301')
                    ->placeholder('Select a redirect type'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('from')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Redirect $redirect) => $redirect->from),
                Tables\Columns\TextColumn::make('to')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Redirect $redirect) => $redirect->to),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M jS, Y g:i A'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRedirects::route('/'),
            'create' => Pages\CreateRedirect::route('/create'),
            'edit' => Pages\EditRedirect::route('/{record}/edit'),
        ];
    }
}
