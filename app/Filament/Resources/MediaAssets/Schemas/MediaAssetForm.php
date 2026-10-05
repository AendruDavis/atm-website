<?php

namespace App\Filament\Resources\MediaAssets\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MediaAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Media file')->schema([
                Hidden::make('disk')->default('public'),
                Hidden::make('created_by')->default(fn (): ?int => auth()->id()),
                FileUpload::make('path')
                    ->required()
                    ->disk('public')
                    ->directory('media')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                    ->maxSize(10240)
                    ->storeFileNamesIn('original_name')
                    ->columnSpanFull(),
                TextInput::make('alt_text')->maxLength(255),
                Textarea::make('caption')->rows(3)->columnSpanFull(),
            ])->columns(2),
        ]);
    }
}
