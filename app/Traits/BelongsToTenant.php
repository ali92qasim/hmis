<?php

namespace App\Traits;

use App\Models\Tenant;
use App\Models\Scopes\TenantScope;
trait BelongsToTenant
{
    protected static function bootBelongsToTenant() : void
    {
        static::addGlobalScope(new TenantScope());
        static::creating(function ($model) {
            if(session()->has('tenant_id')) {
                $model->tenant_id = session()->get('tenant_id');
            }
        });
    }

    public function tenant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
