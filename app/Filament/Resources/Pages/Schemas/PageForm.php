<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Enums\PublicationStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Page content')->schema([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('eyebrow')->maxLength(255),
                Textarea::make('summary')->rows(4)->columnSpanFull(),
                TagsInput::make('content')->helperText('Add each content paragraph as a separate item.')->columnSpanFull(),
            ])->columns(2),
            Section::make('Publishing')->schema([
                Select::make('status')->options(self::publicationOptions())->default(PublicationStatus::Draft->value)->required(),
                DateTimePicker::make('published_at'),
            ])->columns(2),
            Section::make('Search appearance')->collapsed()->schema([
                TextInput::make('seo_title')->maxLength(255),
                Textarea::make('seo_description')->rows(3)->columnSpanFull(),
                TextInput::make('canonical_url')->url()->maxLength(2048),
                Select::make('social_media_id')->relationship('socialImage', 'original_name')->searchable()->preload()->label('Social image'),
                Toggle::make('seo_index')->default(true),
                Toggle::make('seo_follow')->default(true),
            ])->columns(2),
        ]);
    }

    private static function publicationOptions(): array
    {
        return collect(PublicationStatus::cases())->mapWithKeys(fn (PublicationStatus $status): array => [$status->value => $status->label()])->all();
    }
}
