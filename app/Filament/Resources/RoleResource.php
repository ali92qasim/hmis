<?php

namespace App\Filament\Resources;

use Althinect\FilamentSpatieRolesPermissions\Resources\RoleResource as BaseRoleResource;
use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class RoleResource extends BaseRoleResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name'))
                                    ->required()
                                    ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule) {
                                        if (config('permission.teams', false) && Filament::hasTenancy()) {
                                            $rule->where(config('permission.column_names.team_foreign_key', 'tenant_id'), Filament::getTenant()->id);
                                        }
                                        return $rule;
                                    }),

                                Select::make('guard_name')
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                                    ->options(config('filament-spatie-roles-permissions.guard_names'))
                                    ->default(config('filament-spatie-roles-permissions.default_guard_name'))
                                    ->visible(fn() => config('filament-spatie-roles-permissions.should_show_guard', true))
                                    ->required(),

                                Select::make('permissions')
                                    ->columnSpanFull()
                                    ->multiple()
                                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.permissions'))
                                    ->relationship(
                                        name: 'permissions',
                                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('name'),
                                    )
                                    ->visible(config('filament-spatie-roles-permissions.should_show_permissions_for_roles'))
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name} ({$record->guard_name})")
                                    ->searchable(['name', 'guard_name']) // searchable on both name and guard_name
                                    ->preload(config('filament-spatie-roles-permissions.preload_permissions')),
                            ]),
                    ]),
            ]);
    }
}
