<?php

declare(strict_types=1);

namespace application\core\http\exceptions;

use application\core\exceptions\HTTPException;

/**
 * Represents an HTTP 404 Not Found exception.
 *
 * This exception is thrown when the requested resource is not found on the server.
 * It extends the `HTTPException` class and sets the appropriate HTTP status code and error message.
 */
final class NotFoundException extends HTTPException
{
    /**
     * The HTTP status code for this exception.
     *
     * @var int
     */
    protected $code = 404;

    /**
     * The error message for this exception.
     *
     * @var string
     */
    protected $message = 'Oops! 😖 The requested URL was not found on this server.';
}
