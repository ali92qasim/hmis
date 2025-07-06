<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Department extends Model
{
    use BelongsToTenant;
    public function visits() : HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
