<?php

namespace App\Filament\Resources\RestaurantDocumentResource\Pages;

use App\Filament\Resources\RestaurantDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRestaurantDocuments extends ListRecords
{
    protected static string $resource = RestaurantDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
