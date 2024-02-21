<?php

namespace App\Exceptions\Auth;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

class ResetPasswordLimitException extends BaseException
{
    /**
     * @return boolean
     */
    public function sendReport(): bool
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getMessageBase(): mixed
    {
        return trans( 'auth.password.reset.limit.error' );
    }

    /**
     * Return message key.
     *
     * @return int|string
     */
    public function getInternalCodeBase(): int|string
    {
        return ApiHttpStatus::INTERNAL_SERVER_ERROR;
    }

    /**
     * @return mixed
     */
    public function getStatusCodeBase(): mixed
    {
        return ApiHttpStatus::INTERNAL_SERVER_ERROR;
    }
}
