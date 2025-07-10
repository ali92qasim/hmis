<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    public function team(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
