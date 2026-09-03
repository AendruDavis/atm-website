<?php

namespace App\Filament\Resources\SurveyRequests\Pages;

use App\Filament\Resources\SurveyRequests\SurveyRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSurveyRequest extends EditRecord
{
    protected static string $resource = SurveyRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
