<?php

namespace App\Filament\Resources\AuditLogs\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AuditLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('event')->badge()->searchable()->sortable(),
            TextColumn::make('auditable_type')->label('Record type')->formatStateUsing(fn (string $state): string => class_basename($state))->searchable(),
            TextColumn::make('auditable_id')->label('Record ID')->sortable(),
            TextColumn::make('user.name')->label('User')->searchable()->placeholder('System'),
            TextColumn::make('ip_address')->toggleable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->defaultSort('created_at', 'desc');
    }
}
