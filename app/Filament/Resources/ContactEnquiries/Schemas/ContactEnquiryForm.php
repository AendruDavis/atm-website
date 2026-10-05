<?php

namespace App\Filament\Resources\ContactEnquiries\Schemas;

use App\Enums\EnquiryStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactEnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Submission')->schema([
                TextInput::make('name')->disabled(),
                TextInput::make('organization')->disabled(),
                TextInput::make('email')->disabled(),
                TextInput::make('telephone')->disabled(),
                TextInput::make('project_type')->disabled(),
                TextInput::make('location')->disabled(),
                Select::make('service_id')->relationship('service', 'title')->disabled()->label('Service'),
                DatePicker::make('preferred_survey_date')->disabled(),
                Textarea::make('project_description')->disabled()->rows(6)->columnSpanFull(),
                TextInput::make('attachment_original_name')->disabled()->label('Attachment')->columnSpanFull(),
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
