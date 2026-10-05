<?php

namespace App\Filament\Resources\ContactEnquiries\Tables;

use App\Enums\EnquiryStatus;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactEnquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('telephone')->searchable(),
            TextColumn::make('service.title')->label('Service')->searchable(),
            TextColumn::make('status')->badge()->sortable(),
            TextColumn::make('submitted_at')->dateTime()->sortable(),
        ])->filters([
            SelectFilter::make('status')->options(collect(EnquiryStatus::cases())->mapWithKeys(fn (EnquiryStatus $status): array => [$status->value => $status->label()])->all()),
        ])->defaultSort('submitted_at', 'desc')->recordActions([EditAction::make()]);
    }
}
