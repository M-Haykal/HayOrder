<?php

namespace App\Filament\Resources\ReportRestaurantResource\Pages;

use App\Filament\Resources\ReportRestaurantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportRestaurants extends ListRecords
{
    protected static string $resource = ReportRestaurantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
