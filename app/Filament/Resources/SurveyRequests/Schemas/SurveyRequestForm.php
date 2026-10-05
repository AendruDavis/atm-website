<?php

namespace App\Filament\Resources\SurveyRequests\Schemas;

use App\Enums\EnquiryStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SurveyRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Survey request')->schema([
                TextInput::make('reference')->disabled(),
                TextInput::make('name')->disabled(),
                TextInput::make('organization')->disabled(),
                TextInput::make('email')->disabled(),
                TextInput::make('telephone')->disabled(),
                TextInput::make('project_type')->disabled(),
                TextInput::make('location')->disabled(),
                TextInput::make('latitude')->disabled(),
                TextInput::make('longitude')->disabled(),
                Select::make('service_id')->relationship('service', 'title')->disabled()->label('Service'),
                DatePicker::make('preferred_survey_date')->disabled(),
                Textarea::make('project_description')->disabled()->rows(6)->columnSpanFull(),
            ])->columns(2),
            Section::make('Internal workflow')->schema([
                Select::make('status')->options(self::statusOptions())->required(),
                Textarea::make('internal_notes')->rows(6)->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    private static function statusOptions(): array
    {
        return collect(EnquiryStatus::cases())->mapWithKeys(fn (EnquiryStatus $status): array => [$status->value => $status->label()])->all();
    }
}
