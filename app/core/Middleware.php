<?php

declare(strict_types=1);

namespace application\core;

/**
 * The Middleware interface defines the contract for all middleware components in the application.
 * Middleware components are responsible for handling requests and returning a boolean value indicating whether the request should be processed further.
 */
interface Middleware
{
    /**
     * Handles the request and returns a boolean value indicating whether the request should be processed further.
     *
     * @return bool true if the request should be processed further, false otherwise.
     */
    public function handle(): bool;
}
