<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    //
    use BelongsToTenant;
}
