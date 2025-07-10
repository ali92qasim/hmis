<?php

namespace App\Filament\Pages\Auth;

use App\Models\Role;
use App\Models\Tenant;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\Component;
use Filament\Forms;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        Forms\Components\Wizard::make([
                            Forms\Components\Wizard\Step::make('Hospital Info')
                                ->schema([
                                    $this->getTenantComponent(),
                                ]),

                            Forms\Components\Wizard\Step::make('User Info')
                                ->schema([
                                    $this->getNameFormComponent(),
                                    $this->getEmailFormComponent(),
                                    $this->getPasswordFormComponent(),
                                    $this->getPasswordConfirmationFormComponent(),
                                ]),
                        ])
                            ->submitAction(
                                Actions\Action::make('submit')
                                    ->label('Submit')
                                    ->submit('register')
                            )
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getTenantComponent(): Component
    {
        return Forms\Components\TextInput::make('hospital_name')
            ->required();
    }

    protected function getFormActions(): array
    {
        return [];
    }
    protected function handleRegistration(array $data) : Model
    {
        try {
            $tenant = Tenant::create([
                'name' => $data['hospital_name'],
            ]);

            unset($data['hospital_name']);

            $data['tenant_id'] = $tenant->id;

            $role = Role::firstOrCreate([
                'name' => 'admin',
                'tenant_id' => $tenant->id,
                'guard_name' => 'web',
            ]);
            app(PermissionRegistrar::class)->setPermissionsTeamId($tenant->id);
            $user = parent::handleRegistration($data);
            $user->assignRole($role);
            $role->syncPermissions(Permission::all());
            return $user;

        } catch (\Throwable $e) {
            logger()->error('Tenant creation failed during registration', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
            Notification::make()
                ->title('Something went wrong while setting up the hospital.')
                ->danger()
                ->send();
            throw $e;
        }
    }
}
