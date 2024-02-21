<?php

namespace App\Exceptions\_Base;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

class ItemNotFoundException extends BaseException
{
    /**
     * @return boolean
     */
    public function sendReport()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getMessageBase()
    {
        return trans( 'exception._base.item_not_found' );
    }

    /**
     * Return message key.
     *
     * @return int|string
     */
    public function getInternalCodeBase()
    {
        return ApiHttpStatus::NOT_FOUND;
    }

    /**
     * @return mixed
     */
    public function getStatusCodeBase()
    {
        return ApiHttpStatus::NOT_FOUND;
    }
}
