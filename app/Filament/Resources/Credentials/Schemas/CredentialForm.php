<?php

namespace App\Filament\Resources\Credentials\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CredentialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Credential')->schema([
                TextInput::make('type')->required()->maxLength(255),
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('registration_number')->maxLength(255),
                TextInput::make('issuing_body')->maxLength(255),
                Textarea::make('insurance_information')->rows(4)->columnSpanFull(),
                Toggle::make('is_verified'),
                Select::make('verified_by')->relationship('verifier', 'name')->searchable()->preload()->label('Verified by'),
                DateTimePicker::make('verified_at'),
                TextInput::make('sort_order')->numeric()->default(0)->required(),
            ])->columns(2),
        ]);
    }
}
