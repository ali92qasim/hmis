<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RadiologyTestType extends Model
{
    use BelongsToTenant;
    public function radiologyTests(): HasMany
    {
        return $this->hasMany(RadiologyTest::class);
    }
}
