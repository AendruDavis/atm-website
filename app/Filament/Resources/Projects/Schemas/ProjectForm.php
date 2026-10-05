<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\PublicationStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Project details')->schema([
                TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                Select::make('project_category_id')->relationship('category', 'name')->searchable()->preload()->required()->label('Category'),
                TextInput::make('location')->maxLength(255),
                TextInput::make('project_type')->maxLength(255),
                TextInput::make('client_sector')->maxLength(255),
                DatePicker::make('project_date'),
                Select::make('services')->relationship('services', 'title')->multiple()->searchable()->preload(),
                Select::make('featured_media_id')->relationship('featuredImage', 'original_name')->searchable()->preload()->label('Featured image'),
                Select::make('download_media_id')->relationship('download', 'original_name')->searchable()->preload()->label('Download'),
                Textarea::make('overview')->required()->rows(5)->columnSpanFull(),
                TagsInput::make('services_provided')->columnSpanFull(),
                TagsInput::make('outcomes')->columnSpanFull(),
            ])->columns(2),
            Section::make('Publishing')->schema([
                Select::make('status')->options(self::publicationOptions())->default(PublicationStatus::Draft->value)->required(),
                DateTimePicker::make('published_at'),
                Toggle::make('is_featured'),
                TextInput::make('sort_order')->numeric()->default(0)->required(),
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
