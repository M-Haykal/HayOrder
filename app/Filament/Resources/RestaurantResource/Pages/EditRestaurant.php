<?php

namespace App\Filament\Resources\RestaurantResource\Pages;

use App\Filament\Resources\RestaurantResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Carbon;


class EditRestaurant extends EditRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['status'] === 'approved') {
            $data['verified_at'] = Carbon::now();
        } else {
            $data['verified_at'] = null;
        }

        return $data;
    }
}
