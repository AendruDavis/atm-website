<?php

namespace App\Filament\Widgets;

use App\Models\AuditLog;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentActivity extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(AuditLog::query()->with('user')->latest('created_at'))
            ->columns([
                TextColumn::make('event')
                    ->badge(),
                TextColumn::make('auditable_type')
                    ->label('Content type')
                    ->formatStateUsing(fn (?string $state): string => class_basename($state ?? 'Unknown')),
                TextColumn::make('user.name')
                    ->placeholder('System'),
                TextColumn::make('created_at')
                    ->since(),
            ])
            ->paginated(false);
    }
}
