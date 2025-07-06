<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class PathologyTestType extends Model
{
    use BelongsToTenant;
    public function pathologyTests(): HasMany
    {
        return $this->hasMany(PathologyTest::class);
    }
}
