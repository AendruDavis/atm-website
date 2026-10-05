<?php

namespace App\Filament\Resources\AuditLogs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AuditLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Audit event')->schema([
                TextInput::make('event')->disabled(),
                TextInput::make('user.name')->disabled()->label('User'),
                TextInput::make('auditable_type')->disabled()->label('Record type'),
                TextInput::make('auditable_id')->disabled()->label('Record ID'),
                TextInput::make('ip_address')->disabled(),
                Textarea::make('old_values')->disabled()->columnSpanFull(),
                Textarea::make('new_values')->disabled()->columnSpanFull(),
            ])->columns(2),
        ]);
    }
}
