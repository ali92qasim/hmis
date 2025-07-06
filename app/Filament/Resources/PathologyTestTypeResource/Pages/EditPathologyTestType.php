<?php

namespace App\Filament\Resources\PathologyTestTypeResource\Pages;

use App\Filament\Resources\PathologyTestTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPathologyTestType extends EditRecord
{
    protected static string $resource = PathologyTestTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
