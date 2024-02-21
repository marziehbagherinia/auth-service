<?php

namespace App\Exceptions\_Base;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

class BadRequestException extends BaseException
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
        return trans( 'exception._base.bad_request' );
    }

    /**
     * Return message key.
     *
     * @return int
     */
    public function getInternalCodeBase(): int
    {
        return ApiHttpStatus::BAD_REQUEST;
    }

    /**
     * @return int
     */
    public function getStatusCodeBase(): int
    {
        return ApiHttpStatus::BAD_REQUEST;
    }
}
