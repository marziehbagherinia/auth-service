<?php

namespace App\Exceptions\Auth;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

class InvalidResetPasswordInputException extends BaseException
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
        return trans( 'auth.password.reset.inputs.error' );
    }

    /**
     * Return message key.
     *
     * @return int|string
     */
    public function getInternalCodeBase(): int|string
    {
        return ApiHttpStatus::VALIDATION;
    }

    /**
     * @return mixed
     */
    public function getStatusCodeBase(): mixed
    {
        return ApiHttpStatus::VALIDATION;
    }
}
