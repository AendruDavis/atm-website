<?php

namespace App\Filament\Resources\SurveyRequests;

use App\Filament\Resources\SurveyRequests\Pages\CreateSurveyRequest;
use App\Filament\Resources\SurveyRequests\Pages\EditSurveyRequest;
use App\Filament\Resources\SurveyRequests\Pages\ListSurveyRequests;
use App\Filament\Resources\SurveyRequests\Schemas\SurveyRequestForm;
use App\Filament\Resources\SurveyRequests\Tables\SurveyRequestsTable;
use App\Models\SurveyRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SurveyRequestResource extends Resource
{
    protected static ?string $model = SurveyRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SurveyRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SurveyRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveyRequests::route('/'),
            'create' => CreateSurveyRequest::route('/create'),
            'edit' => EditSurveyRequest::route('/{record}/edit'),
        ];
    }
}
