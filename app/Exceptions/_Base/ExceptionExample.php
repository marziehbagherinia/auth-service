<?php

namespace App\Exceptions\_Base;

use App\Exceptions\_Base\BaseException;

class ExceptionExample extends BaseException
{
    /*
     * Return Send Report.
     *
     * @return string
     */
    public function sendReport()
    {
        return false;
    }

    /*
     * Return message key.
     *
     * @return string
     */
    public function getInternalCodeBase()
    {
        return 7200;
    }

    /*
     * Return http code.
     *
     * @return string
     */
    public function getStatusCodeBase()
    {
        return 404;
    }
}
