<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Enums\PublicationStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service details')
                    ->description('Public-facing information for this service.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('eyebrow')
                            ->maxLength(255),
                        Textarea::make('summary')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        TagsInput::make('description')
                            ->helperText('Add each paragraph as a separate item.')
                            ->columnSpanFull(),
                        TagsInput::make('deliverables')
                            ->columnSpanFull(),
                        TagsInput::make('applications')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Publishing')
                    ->schema([
                        Select::make('status')
                            ->options(collect(PublicationStatus::cases())->mapWithKeys(fn (PublicationStatus $status): array => [$status->value => $status->label()])->all())
                            ->default(PublicationStatus::Draft->value)
                            ->required(),
                        DateTimePicker::make('published_at'),
                        Toggle::make('is_featured'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(2),
                Section::make('Search appearance')
                    ->collapsed()
                    ->schema([
                        TextInput::make('seo_title')
                            ->maxLength(255),
                        Textarea::make('seo_description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
