<?php

namespace App\Exceptions\Users;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

class TokenNotFoundException extends BaseException
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
        return trans('user.token.not_found');
    }

    /**
     * Return message key.
     *
     * @return int|string
     */
    public function getInternalCodeBase(): int|string
    {
        return ApiHttpStatus::NOT_FOUND;
    }

    /**
     * @return mixed
     */
    public function getStatusCodeBase(): mixed
    {
        return ApiHttpStatus::NOT_FOUND;
    }
}
