<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Billing extends Model
{
    use BelongsToTenant;
    public function billingType(): BelongsTo
    {
        return $this->belongsTo(BillingType::class);
    }
}
