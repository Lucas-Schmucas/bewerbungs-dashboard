<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\Company;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Notification;

class CreateApplication extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = ApplicationResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return Notification::make()
            ->success()
            ->title('Application created')
            ->body('The application has bin created successfully.');
    }

    protected function getSteps(): array
    {
        return [
            Step::make('Company')
                ->description('Choose a company...')
                ->schema([
                    Select::make('company_id')
                        ->relationship('company', 'name')
                        ->required()
                        ->suffixAction(
                            Action::make('create new Company')
                                ->icon('heroicon-o-building-office-2')
                                ->form([
                                    TextInput::make('name')
                                        ->string()
                                        ->required(),
                                    TextInput::make('url')
                                        ->url()
                                        ->required(),
                                    TextInput::make('street')
                                        ->string()
                                        ->required(),
                                    TextInput::make('zip')
                                        ->string()
                                        ->required(),
                                    TextInput::make('travel_time_train')
                                        ->string()
                                        ->required(),
                                    TextInput::make('travel_time_car')
                                        ->string()
                                        ->required(),
                                    TextInput::make('company_type')
                                        ->string()
                                        ->required(),
                                ])
                                ->action(function (array $data, Application $application): void {
                                    $company = Company::create($data);
                                    $application->company()->associate($company);
                                    $application->save();
                                }),
                        ),

                ]),
            Step::make('Application Details')
                ->description('Add infos about the Application')
                ->schema([
                    Select::make('company_id')
                        ->relationship('company', 'name')
                        ->required(),
                    TextInput::make('position_name')
                        ->string()
                        ->required(),
                    Textarea::make('notes')
                        ->string(),
                    TextInput::make('expected_salary')
                        ->integer(),
                    DatePicker::make('application_sent')
                        ->date(),
                    DatePicker::make('interview_date')
                        ->date(),
                    Select::make('status_id')
                        ->relationship('status', 'label')
                        ->required(),
                ]),
        ];
    }
}
