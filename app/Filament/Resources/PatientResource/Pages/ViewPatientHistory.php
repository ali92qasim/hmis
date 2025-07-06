<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use App\Models\Department;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Actions\Action;


class ViewPatientHistory extends ViewRecord
{
    protected static string $resource = PatientResource::class;
    protected static ?string $title = 'Patient History';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('add-visit')
                ->label('Add Visit')
                ->icon('heroicon-o-calendar')
                ->form([
                    Forms\Components\Select::make('type')
                        ->required()
                        ->options([
                            'IPD' => 'IPD',
                            'OPD' => 'OPD',
                            'Emergency' => 'Emergency',
                        ]),
                    Forms\Components\Select::make('department_id')
                        ->label('Department')
                        ->options(Department::query()->pluck('name', 'id'))
                        ->required(),
                    Forms\Components\DatePicker::make('visit_date')
                        ->label('Date')
                        ->required()
                        ->native(false),
                    Forms\Components\Textarea::make('reason'),
                    Forms\Components\Textarea::make('clinical_notes'),
                    Forms\Components\Textarea::make('prescription'),
                    Forms\Components\Textarea::make('diagnosis'),
                ])
                ->action(function (array $data, $record) {
                    $record->visits()->create($data);
                    Notification::make()
                        ->title('Created')
                        ->success()
                        ->send();
                }),
        ];
    }
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        RepeatableEntry::make('visits')
                            ->getStateUsing(function($record) {
                                return collect($record->visits)->sortByDesc('visit_date');
                            })
                            ->schema([
                                TextEntry::make('visit_date')
                                    ->label('Date'),
                                TextEntry::make('type'),
                                TextEntry::make('department.name')
                                    ->label('Department'),
                                TextEntry::make('reason'),
                                TextEntry::make('clinical_notes'),
                                TextEntry::make('diagnosis'),
                                TextEntry::make('prescription'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ])
                    ,
            ]);
    }

}
