<?php

declare(strict_types = 1);

namespace application\core\http\exceptions;

use application\core\exceptions\HTTPException;

/**
 * Represents an HTTP 405 Method Not Allowed exception.
 *
 * This exception is thrown when the requested HTTP method is not allowed for a specific resource.
 * It extends the `HTTPException` class and sets the appropriate HTTP status code and error message.
 */
final class MethodNotAllowedException extends HTTPException 
{
    /**
     * The HTTP status code for this exception.
     *
     * @var int
     */
    protected $code = 405;

    /**
     * The error message for this exception.
     *
     * @var string
     */
    protected $message = 'Oops! 😖 The request method is not allowed for this specific resource.';
}