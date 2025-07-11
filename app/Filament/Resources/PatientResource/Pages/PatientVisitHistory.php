<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use App\Models\Visit;
use App\Services\VisitForm;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;

class PatientVisitHistory extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;
    public Patient $record;
    protected static string $resource = PatientResource::class;

    protected static string $view = 'filament.resources.patient-resource.pages.patient-visit-history';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => $this->record->visits()->latest('visit_date')->getQuery())
            ->columns([
                Tables\Columns\Layout\View::make('visits.table.row-content')
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->model(Visit::class)
                    ->form(VisitForm::schema()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->model(Visit::class)
                    ->form(VisitForm::schema()),
            ]);
    }
}
