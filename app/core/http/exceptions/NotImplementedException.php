<?php

declare(strict_types = 1);

namespace application\core\http\exceptions;

use application\core\exceptions\HTTPException;

/**
 * Represents an HTTP 501 Not Implemented exception.
 *
 * This exception is thrown when the requested functionality is not implemented on the server.
 * It extends the `HTTPException` class and sets the appropriate HTTP status code and error message.
 */
final class NotImplementedException extends HTTPException 
{
    /**
     * The HTTP status code for this exception.
     *
     * @var int
     */
    protected $code = 501;

    /**
     * The error message for this exception.
     *
     * @var string
     */
    protected $message = 'Oops! 😖 Request method not supported.';
}