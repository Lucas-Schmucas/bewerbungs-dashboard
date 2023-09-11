<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use App\Models\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('company_name')
                    ->string()
                    ->required(),
                TextInput::make('position_name')
                    ->string()
                    ->required(),
                TextInput::make('url')
                    ->string()
                    ->required(),
                Textarea::make('notes')
                    ->string(),
                TextInput::make('expected_salary')
                    ->integer(),
                DatePicker::make('application_sent')
                    ->date(),
                DatePicker::make('first_reply')
                    ->date(),
                DatePicker::make('interview_date')
                    ->date(),
                Select::make('status_id')
                    ->relationship('status', 'label')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $labelColors = Status::labelColors();
        return $table
            ->columns([
                TextColumn::make('company_name')->searchable(),
                TextColumn::make('position_name')->searchable(),
                TextColumn::make('expected_salary'),
                TextColumn::make('application_sent')
                    ->date(),
                TextColumn::make('first_reply')
                    ->date(),
                TextColumn::make('interview_date')
                    ->date(),
                TextColumn::make('status.label')
                    ->badge()
                    ->color(static function ($state) use ($labelColors): string {
                        return $labelColors[$state];
                    })
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
