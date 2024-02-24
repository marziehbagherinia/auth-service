<?php

namespace App\Enums\Cache;

use App\Enums\Enum;

/**
 * Class CacheTags.
 */
class CacheTags extends Enum
{
    const USER_PERMISSIONS = 'user_permissions';
    const USER_ROLES = 'user_roles';
    const USER_RESET_PASSWORD = 'user_reset_password';
}
