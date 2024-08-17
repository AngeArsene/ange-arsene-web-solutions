<?php

declare(strict_types = 1);

namespace application\core\exceptions;

use Exception;

/**
 * Represents an abstract base class for HTTP-related exceptions.
 *
 * This class extends the `Exception` class and provides common functionality for HTTP-related exceptions.
 * It defines an abstract `label()` method that returns a label for the exception based on the HTTP status code,
 * and a `parameters()` method that returns an array of exception parameters.
 */
abstract class HTTPException extends Exception 
{
    /**
     * Returns a label for the exception based on the HTTP status code.
     *
     * @return string The label for the exception.
     */
    public function label(): string
    {
        return match ($this->code) {
            403 => 'Forbidden',
            404 => 'Page Not Found',
            405 => 'Method Not Allowed',
            501 => 'Not Implemented'
        };
    }

    /**
     * Returns an array of exception parameters, including the status code, message, and label.
     *
     * @return array The array of exception parameters.
     */
    public function parameters(): array
    {
        return [
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
            'label' => $this->label()
        ];
    }
}