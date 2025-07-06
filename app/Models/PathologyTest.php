<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PathologyTest extends Model
{
    use BelongsToTenant;
    public function pathologyTestType(): BelongsTo
    {
        return $this->belongsTo(PathologyTestType::class);
    }
}
