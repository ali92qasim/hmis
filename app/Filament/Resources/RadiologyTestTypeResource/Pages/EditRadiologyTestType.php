<?php

namespace App\Filament\Resources\RadiologyTestTypeResource\Pages;

use App\Filament\Resources\RadiologyTestTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRadiologyTestType extends EditRecord
{
    protected static string $resource = RadiologyTestTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
