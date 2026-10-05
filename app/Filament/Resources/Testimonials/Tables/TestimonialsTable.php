<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('client_name')->searchable()->sortable(),
            TextColumn::make('organization')->searchable(),
            TextColumn::make('project_type')->searchable(),
            TextColumn::make('status')->badge()->sortable(),
            IconColumn::make('is_featured')->boolean()->label('Featured'),
            TextColumn::make('sort_order')->label('Order')->sortable(),
        ])->defaultSort('sort_order')->recordActions([EditAction::make()])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
