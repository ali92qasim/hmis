<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Filament\Forms;
final class VisitForm
{
    public static function schema() : array
    {
        return [
            Forms\Components\Select::make('patient_id')
                ->relationship('patient', 'first_name')
                ->required(),
//                Forms\Components\Select::make('doctor_id')
//                    ->label('Doctor')
//                    ->required()
//                    ->options(fn () => User::role('doctor')->pluck('name', 'id'))
//                    ->searchable(),
            Forms\Components\Select::make('doctor_id')
                ->label('Doctor')
                ->relationship('doctor', 'name')
                ->searchable()
                ->options(function () {
                    if (!Role::where('name', 'doctor')->exists()) {
                        return [];
                    }
                    return User::role('doctor')
                        ->pluck('name', 'id');
                })
                ->required(),
            Forms\Components\Select::make('department_id')
                ->label('Department')
                ->relationship('department', 'name')
                ->searchable()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required(),
                ]),
            Forms\Components\Select::make('type')
                ->required()
                ->options([
                    'IPD' => 'IPD',
                    'OPD' => 'OPD',
                    'Emergency' => 'Emergency',
                ]),
            Forms\Components\DateTimePicker::make('visit_date')
                ->required()
                ->native(false),
            Forms\Components\Textarea::make('reason')
                ->columnSpanFull(),
            Forms\Components\Textarea::make('clinical_notes')
                ->columnSpanFull(),
            Forms\Components\TextInput::make('prescription')
                ->maxLength(255),
            Forms\Components\TextInput::make('diagnosis')
                ->maxLength(255),
        ];
    }
}
