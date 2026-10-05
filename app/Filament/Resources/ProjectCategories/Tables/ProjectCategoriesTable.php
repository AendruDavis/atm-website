<?php

namespace App\Filament\Resources\ProjectCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('projects_count')->counts('projects')->label('Projects')->sortable(),
            TextColumn::make('sort_order')->label('Order')->sortable(),
            TextColumn::make('updated_at')->dateTime()->sortable(),
        ])->defaultSort('sort_order')->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
