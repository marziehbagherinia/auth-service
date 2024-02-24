<?php

namespace App\Enums\Users;

use App\Enums\Enum;

class UserType extends Enum
{
    const SUPER_ADMIN = 'super-admin';

    const ADMIN = 'admin';
    const CUSTOMER = 'customer';
    const SELLER = 'seller';
}
