<?php

namespace App\Filament\Resources\RestaurantDocumentResource\Pages;

use App\Filament\Resources\RestaurantDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestaurantDocument extends EditRecord
{
    protected static string $resource = RestaurantDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
