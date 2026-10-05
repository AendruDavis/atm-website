<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Enums\PublicationStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Article')->schema([
                TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('reading_time')->numeric()->minValue(1)->suffix('minutes'),
                Select::make('author_id')->relationship('author', 'name')->searchable()->preload()->required(),
                Select::make('category_id')->relationship('category', 'name')->searchable()->preload()->required(),
                Select::make('tags')->relationship('tags', 'name')->multiple()->searchable()->preload(),
                Select::make('featured_media_id')->relationship('featuredImage', 'original_name')->searchable()->preload()->label('Featured image'),
                Textarea::make('excerpt')->required()->rows(3)->columnSpanFull(),
                TagsInput::make('content')->helperText('Add each article paragraph as a separate item.')->columnSpanFull(),
            ])->columns(2),
            Section::make('Publishing')->schema([
                Select::make('status')->options(self::publicationOptions())->default(PublicationStatus::Draft->value)->required(),
                DateTimePicker::make('published_at'),
                Toggle::make('is_featured'),
                Toggle::make('is_popular'),
                TextInput::make('popular_order')->numeric()->default(0),
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
