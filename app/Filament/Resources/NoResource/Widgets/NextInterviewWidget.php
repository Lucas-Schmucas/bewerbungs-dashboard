<?php

namespace App\Filament\Resources\NoResource\Widgets;

use App\Models\Application;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NextInterviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Next Interview', $this->getNextInterview()),
        ];
    }

    private function  getNextInterview() : string
    {
        return Application::getNextInterview();
    }
}
