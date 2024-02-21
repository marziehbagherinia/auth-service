<?php

namespace App\Exceptions\_Base;

use Exception;

abstract class BaseException extends Exception
{
    public $data;

    /**
     * BaseException constructor.
     *
     * @param string $message
     */
    public function __construct( $message = "", $data = [] )
    {
        $this->data = $data;
    }

    /**
	 * Return send report.
	 *
	 * @return string
	 */
    public function sendReportBase()
    {
        return false;
    }

    /**
     * Return send report.
     *
     * @return string
     */
    abstract public function getStatusCodeBase();

    /**
     * Return send report.
     *
     * @return string
     */
    abstract public function getInternalCodeBase();

    /**
     * Return send report.
     *
     * @return string
     */
    public function getMessageBase()
    {
        if( !empty( $this->getMessage() ) )
        {
            return $this->getMessage();
        }

        if( !empty( $this->getInternalCodeBase() ) )
        {
            return trans( 'enum.internal_codes.'.$this->getInternalCodeBase() );
        }

        return trans( 'enum.status_codes.'.$this->getStatusCodeBase() );
    }

    /**
     * Return send report.
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
