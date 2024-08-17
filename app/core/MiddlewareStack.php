<?php

declare(strict_types=1);

namespace application\core;

use Exception;

/**
 * The MiddlewareStack class is responsible for managing the application's middleware stack.
 * It provides methods to add new middleware to the stack and to check if a specific middleware exists in the stack.
 */
final class MiddlewareStack
{
    /**
     * An associative array that stores the registered middleware, with the middleware alias as the key and the middleware class name as the value.
     */
    private static array $middleware_stack = [];

    /**
     * Adds a new middleware to the stack.
     *
     * @param string $alias The alias or identifier for the middleware.
     * @param string $middleware_class The fully qualified class name of the middleware.
     */
    public function add(string $alias, string $middleware_class): void
    {
        self::$middleware_stack[$alias] = $middleware_class;
    }

    /**
     * Checks if a specific middleware is registered in the stack.
     *
     * @param string $middleware The alias or identifier of the middleware to check.
     * @return string|bool The fully qualified class name of the middleware if it exists, or false if it does not.
     */
    public static function has(string $middleware): string | bool
    {
        return self::$middleware_stack[$middleware] ?? throw new Exception("Middleware not found in the stack.");
    }
}
