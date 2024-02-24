<?php

namespace App\Exceptions\Roles;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

/**
 * Class RoleNotFoundException
 */
class RoleNotFoundException extends BaseException
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
        return trans('role.not_found');
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
