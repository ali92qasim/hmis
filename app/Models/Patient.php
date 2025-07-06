<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use BelongsToTenant;
    public const CODE_PREFIX = 'PAT';
    public const CODE_SEPARATOR = '-';

    protected static function booted() : void
    {
        static::creating(function ($patient) {
            $patient->patient_code = self::CODE_PREFIX
                . self::CODE_SEPARATOR
                . random_int(100000, 999999);
        });
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
