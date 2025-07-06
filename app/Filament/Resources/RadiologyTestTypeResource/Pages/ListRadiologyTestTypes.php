<?php

namespace App\Filament\Resources\RadiologyTestTypeResource\Pages;

use App\Filament\Resources\RadiologyTestTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRadiologyTestTypes extends ListRecords
{
    protected static string $resource = RadiologyTestTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
