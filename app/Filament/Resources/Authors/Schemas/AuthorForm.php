<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AuthorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Author profile')->schema([
                Select::make('photo_media_id')->relationship('photo', 'original_name')->searchable()->preload()->label('Photo'),
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('job_title')->maxLength(255),
                TextInput::make('linkedin_url')->url()->maxLength(2048),
                Textarea::make('biography')->rows(8)->columnSpanFull(),
            ])->columns(2),
        ]);
    }
}
