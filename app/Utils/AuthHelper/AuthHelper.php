<?php

namespace App\Utils\AuthHelper;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * Class CacheManager.
 */
class AuthHelper
{
    /**
     * Generate token by email.
     *
     * @param $email
     * @return string
     */
    public static function generateTokenByEmail( $email ): string
    {
        return Hash::make($email . Str::uuid()->toString() );
    }
}
