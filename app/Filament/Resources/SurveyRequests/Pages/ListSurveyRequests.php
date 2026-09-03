<?php

namespace App\Filament\Resources\SurveyRequests\Pages;

use App\Filament\Resources\SurveyRequests\SurveyRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSurveyRequests extends ListRecords
{
    protected static string $resource = SurveyRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
