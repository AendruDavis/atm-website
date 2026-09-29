<?php

namespace App\Filament\Widgets;

use App\Models\ContactEnquiry;
use App\Models\Project;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Services', Service::query()->count()),
            Stat::make('Projects', Project::query()->count()),
            Stat::make('New enquiries', ContactEnquiry::query()->where('status', 'unread')->count()),
        ];
    }
}
