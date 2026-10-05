<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use App\Enums\PublicationStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Team member')->schema([
                Select::make('photo_media_id')->relationship('photo', 'original_name')->searchable()->preload()->label('Photo'),
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('job_title')->required()->maxLength(255),
                TextInput::make('linkedin_url')->url()->maxLength(2048),
                Textarea::make('biography')->rows(6)->columnSpanFull(),
                TagsInput::make('qualifications')->columnSpanFull(),
                TagsInput::make('areas_of_expertise')->label('Areas of expertise')->columnSpanFull(),
                TagsInput::make('professional_memberships')->columnSpanFull(),
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
