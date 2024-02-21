<?php

namespace App\Exceptions\_Base;


class UnauthorizedException extends BaseException
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

    /**
     * Return send report.
     *
     * @return string
     */
    public function getInternalCodeBase()
    {
        return 401;
    }

    /*
     * Return http code.
     *
     * @return string
     */
    public function getStatusCodeBase()
    {
        return 401;
    }
}
