<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Brand')->schema([
                TextInput::make('company_name')->required()->maxLength(255),
                TextInput::make('wordmark')->maxLength(255),
                TextInput::make('tagline')->maxLength(255)->columnSpanFull(),
                Textarea::make('company_description')->rows(5)->columnSpanFull(),
            ])->columns(2),
            Section::make('Contact details')->schema([
                TextInput::make('phone')->tel()->maxLength(255),
                TextInput::make('email')->email()->maxLength(255),
                TextInput::make('whatsapp')->tel()->maxLength(255),
                TextInput::make('enquiry_email')->email()->maxLength(255),
                Textarea::make('office_address')->rows(3)->columnSpanFull(),
                Textarea::make('areas_served')->rows(3)->columnSpanFull(),
            ])->columns(2),
            Section::make('Location and social profiles')->collapsed()->schema([
                TextInput::make('latitude')->numeric(),
                TextInput::make('longitude')->numeric(),
                KeyValue::make('social_links')->keyLabel('Network')->valueLabel('Profile URL')->columnSpanFull(),
                TagsInput::make('trust_facts')->helperText('Add each trust statement as a separate item.')->columnSpanFull(),
            ])->columns(2),
            Section::make('Default search appearance')->collapsed()->schema([
                TextInput::make('default_seo_title')->maxLength(255),
                Textarea::make('default_seo_description')->rows(3)->columnSpanFull(),
                Select::make('default_social_media_id')->relationship('defaultSocialImage', 'original_name')->searchable()->preload()->label('Default social image'),
            ])->columns(2),
        ]);
    }
}
