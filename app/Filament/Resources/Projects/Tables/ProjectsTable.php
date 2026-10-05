<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable()->wrap(),
            TextColumn::make('category.name')->searchable()->sortable(),
            TextColumn::make('location')->searchable(),
            TextColumn::make('status')->badge()->sortable(),
            IconColumn::make('is_featured')->boolean()->label('Featured'),
            TextColumn::make('sort_order')->label('Order')->sortable(),
        ])->defaultSort('sort_order')->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
