<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Enums\PublicationStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Client testimonial')->schema([
                Select::make('photo_media_id')->relationship('photo', 'original_name')->searchable()->preload()->label('Photo'),
                TextInput::make('client_name')->required()->maxLength(255),
                TextInput::make('organization')->maxLength(255),
                TextInput::make('position')->maxLength(255),
                TextInput::make('project_type')->maxLength(255),
                Textarea::make('testimonial')->required()->rows(7)->columnSpanFull(),
            ])->columns(2),
            Section::make('Publishing')->schema([
                Select::make('status')->options(self::publicationOptions())->default(PublicationStatus::Draft->value)->required(),
                DateTimePicker::make('published_at'),
                Toggle::make('is_featured'),
                TextInput::make('sort_order')->numeric()->default(0)->required(),
            ])->columns(2),
        ]);
    }

    private static function publicationOptions(): array
    {
        return collect(PublicationStatus::cases())->mapWithKeys(fn (PublicationStatus $status): array => [$status->value => $status->label()])->all();
    }
}
