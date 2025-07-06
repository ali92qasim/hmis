<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class BillingType extends Model
{
    use BelongsToTenant;
    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }
}
