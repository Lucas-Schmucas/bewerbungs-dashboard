<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->string()
                    ->required(),
                TextInput::make('url')
                    ->string()
                    ->required(),
                TextInput::make('street')
                    ->string()
                    ->required(),
                TextInput::make('zip')
                    ->string()
                    ->required(),
                TextInput::make('travel_time_train')
                    ->label('Öffi Travel Time (minutes)')
                    ->string(),
                TextInput::make('travel_time_car')
                    ->label('Car Travel Time (minutes)')
                    ->string(),
                TextInput::make('company_type')
                    ->string()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('name')
                        ->label('Name')
                        ->searchable()
                        ->sortable(),
                    Stack::make([
                        TextColumn::make('url')
                            ->icon('heroicon-m-globe-europe-africa'),
                        TextColumn::make('street')
                            ->default('no street yet'),
                        TextColumn::make('zip')
                            ->default('no zip yet'),
                    ]),
                    Stack::make([
                        TextColumn::make('travel_time_train')
                            ->sortable()
                            ->icon('phosphor-train')
                            ->default('missing'),
                        TextColumn::make('travel_time_car')
                            ->sortable()
                            ->icon('phosphor-car')
                            ->default('missing')
                    ]),
                ])
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
