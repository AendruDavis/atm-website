<?php

namespace App\Filament\Resources\ProjectCategories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Project category')->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                Textarea::make('description')->rows(5)->columnSpanFull(),
                TextInput::make('sort_order')->numeric()->default(0)->required(),
            ])->columns(2),
        ]);
    }
}
