<?php

namespace App\Filament\Pages\Auth;

use App\Models\Tenant;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\Component;
use Filament\Forms;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;

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

        } catch (\Throwable $e) {
            logger()->error('Tenant creation failed during registration', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);

            $this->notify('danger', 'Something went wrong while setting up the hospital. Please try again.');

            throw new $e;
        }

        return parent::handleRegistration($data);
    }
}
