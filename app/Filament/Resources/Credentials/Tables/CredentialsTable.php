<?php

namespace App\Filament\Resources\Credentials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CredentialsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('type')->searchable()->badge(),
            TextColumn::make('registration_number')->searchable()->label('Registration no.'),
            IconColumn::make('is_verified')->boolean()->label('Verified'),
            TextColumn::make('sort_order')->label('Order')->sortable(),
        ])->defaultSort('sort_order')->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
