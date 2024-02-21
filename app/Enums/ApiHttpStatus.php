<?php
namespace App\Enums;

/**
 * Class ApiHttpStatus.
 */
class ApiHttpStatus extends Enum
{
    const OK = 200;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const DUPLICATE_RECORD = 409;
    const VALIDATION = 422;
    const TOKEN_ERROR = 301;
    const INVALID_IP = 302;
    const ACCESS_DENIED = 303;
    const INTERNAL_SERVER_ERROR = 500;
}
