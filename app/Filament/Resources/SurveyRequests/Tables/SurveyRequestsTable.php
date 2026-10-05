<?php

namespace App\Filament\Resources\SurveyRequests\Tables;

use App\Enums\EnquiryStatus;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SurveyRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('reference')->searchable()->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('location')->searchable(),
            TextColumn::make('service.title')->label('Service')->searchable(),
            TextColumn::make('attachments_count')->counts('attachments')->label('Files'),
            TextColumn::make('status')->badge()->sortable(),
            TextColumn::make('submitted_at')->dateTime()->sortable(),
        ])->filters([
            SelectFilter::make('status')->options(collect(EnquiryStatus::cases())->mapWithKeys(fn (EnquiryStatus $status): array => [$status->value => $status->label()])->all()),
        ])->defaultSort('submitted_at', 'desc')->recordActions([EditAction::make()]);
    }
}
