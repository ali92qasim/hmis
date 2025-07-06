<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RadiologyTest extends Model
{
    use BelongsToTenant;
    public function radiologyTestType(): BelongsTo
    {
        return $this->belongsTo(RadiologyTestType::class);
    }
}
