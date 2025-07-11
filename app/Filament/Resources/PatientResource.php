<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Resources\PatientResource\RelationManagers\VisitsRelationManager;
use App\Models\Department;
use App\Models\Patient;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('patient_code')
                    ->disabled()
                    ->label('Patient Code')
                    ->placeholder('Auto-genenrated')
                    ->helperText('This field is automatically generated and cannot be changed.'),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('middle_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('guardian_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->unique()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob')
                    ->label('Date of Birth')
                    ->native(false),
                Forms\Components\TextInput::make('age')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other'
                    ]),
                Forms\Components\Select::make('marital_status')
                    ->options([
                        'Single' => 'Single',
                        'Married' => 'Married',
                        'Divorced' => 'Divorced',
                        'Windowed' => 'Windowed'
                    ]),
                Forms\Components\Select::make('blood_group')
                    ->options([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'AB+' => 'AB+',
                        'AB-' => 'AB-',
                        'O+' => 'O+',
                        'O-' => 'O-'
                    ])
                    ->searchable(),
                Forms\Components\Select::make('identity_type')
                    ->options([
                        'National' => 'National',
                        'Passport' => 'Passport',
                        'Driving' => 'Driving',
                    ]),
                Forms\Components\TextInput::make('identity_number')
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('relative_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('relative_phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Select::make('relation')
                    ->options([
                        'Father' => 'Father',
                        'Mother' => 'Mother',
                        'Spouse' => 'Spouse',
                        'Sibling' => 'Sibling',
                        'Other' => 'Other',
                    ]),
                Forms\Components\Textarea::make('relative_address')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guardian_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Date of Birth'),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('marital_status')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('blood_group')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('identity_type')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('identity_number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('relative_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('relative_phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('relation')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\Action::make('view-history')
                        ->label('Visit History')
                        ->icon('heroicon-o-clock')
                        ->url(fn ($record) => Pages\PatientVisitHistory::getUrl(['record' => $record->getKey()]))
                        ->icon('heroicon-o-clock'),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'visit-history' => Pages\PatientVisitHistory::route('/{record}/visit-history'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->schema([
                        Grid::make(2)
                        ->schema([
                            TextEntry::make('patient_code'),
                            TextEntry::make('first_name'),
                            TextEntry::make('middle_name')
                                ->visible(fn ($record) => filled($record->middle_name)),
                            TextEntry::make('last_name'),
                            TextEntry::make('phone'),
                            TextEntry::make('guardian_name')
                                ->visible(fn ($record) => filled($record->guardian_name)),
                            TextEntry::make('email')
                                ->visible(fn ($record) => filled($record->email)),
                            TextEntry::make('dob')
                                ->label('Date of Birth')
                                ->visible(fn ($record) => filled($record->dob)),
                            TextEntry::make('age'),
                            TextEntry::make('gender')
                                ->visible(fn ($record) => filled($record->gender)),
                            TextEntry::make('marital_status')
                                ->visible(fn ($record) => filled($record->marital_status)),
                            TextEntry::make('blood_group')
                                ->visible(fn ($record) => filled($record->blood_group)),
                            TextEntry::make('identity_type')
                                ->visible(fn ($record) => filled($record->identity_type)),
                            TextEntry::make('identity_number')
                                ->visible(fn ($record) => filled($record->identity_number)),
                            TextEntry::make('address')
                                ->visible(fn ($record) => filled($record->address)),
                        ]),
                    ]),
                Section::make('Relative Information')
                    ->schema([
                        Grid::make(2)
                        ->schema([
                            TextEntry::make('relative_name')
                                ->visible(fn ($record) => filled($record->relative_name)),
                            TextEntry::make('relative_phone')
                                ->visible(fn ($record) => filled($record->relative_phone)),
                            TextEntry::make('relation')
                                ->visible(fn ($record) => filled($record->relation)),
                            TextEntry::make('relative_address')
                                ->visible(fn ($record) => filled($record->relative_address)),
                        ])
                    ])
            ]);
    }
}

