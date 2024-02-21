<?php

namespace App\Enums\Users;

use App\Enums\Enum;

class UserType extends Enum
{
    const CUSTOMER = 'customer';
    const ADMIN = 'admin';
    const SYSTEM = 'system';
}
