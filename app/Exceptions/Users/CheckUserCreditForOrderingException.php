<?php

namespace App\Exceptions\Users;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

class CheckUserCreditForOrderingException extends BaseException
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
        return trans('user.credit.check.ordering.error');
    }

    /**
     * Return message key.
     *
     * @return int|string
     */
    public function getInternalCodeBase(): int|string
    {
        return ApiHttpStatus::BAD_REQUEST;
    }

    /**
     * @return mixed
     */
    public function getStatusCodeBase(): mixed
    {
        return ApiHttpStatus::BAD_REQUEST;
    }
}
