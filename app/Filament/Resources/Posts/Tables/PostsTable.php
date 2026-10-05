<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable()->sortable()->wrap(),
            TextColumn::make('author.name')->searchable()->sortable(),
            TextColumn::make('category.name')->searchable()->sortable(),
            TextColumn::make('status')->badge()->sortable(),
            IconColumn::make('is_featured')->boolean()->label('Featured'),
            TextColumn::make('published_at')->dateTime()->sortable(),
        ])->defaultSort('updated_at', 'desc')->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
