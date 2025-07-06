<?php

namespace App\Filament\Resources\PathologyTestResource\Pages;

use App\Filament\Resources\PathologyTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPathologyTests extends ListRecords
{
    protected static string $resource = PathologyTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
