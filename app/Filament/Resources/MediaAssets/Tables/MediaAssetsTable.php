<?php

namespace App\Filament\Resources\MediaAssets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaAssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('original_name')->searchable()->label('File name')->placeholder('Unnamed file'),
            TextColumn::make('alt_text')->searchable()->wrap(),
            TextColumn::make('mime_type')->label('Type')->toggleable(),
            TextColumn::make('creator.name')->label('Uploaded by')->toggleable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->defaultSort('created_at', 'desc')->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
