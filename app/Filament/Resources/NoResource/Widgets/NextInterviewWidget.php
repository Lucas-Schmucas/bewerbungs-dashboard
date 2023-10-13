<?php

namespace App\Filament\Resources\NoResource\Widgets;

use App\Models\Application;
use App\Services\InterviewDate;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NextInterviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $interviewDate = Application::getNextInterview();

        if($interviewDate === null) {
            return [
                Stat::make('Next Interview', 'No upcoming Interview')
                    ->color('danger')
            ];
        }

        $date = new InterviewDate($interviewDate);

        return [
                Stat::make('Next Interview', $interviewDate),
            ];
    }
}
