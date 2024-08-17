<?php

declare(strict_types=1);

namespace application\core\http;

use application\core\Session;

/**
 * Represents an HTTP response that can be sent back to the client.
 *
 * This class provides methods to set the HTTP status code of the response.
 */
final class Response
{
    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }
    /**
     * Sets the HTTP status code of the response.
     *
     * This method uses the `http_response_code()` function to set the specified status code
     * for the current HTTP response.
     *
     * @param int $code The HTTP status code to set.
     */
    public function set_status_code(int $code): void
    {
        // Set the HTTP status code for the current response
        http_response_code($code);
    }

    public function redirect(?string $path = null, ?array $params = null): void
    {
        if (isset($params)) {
            foreach ($params as $key => $value)
                $this->session->set_flash($key, $value);
        }

        header("Location: " . ($path ?? '/'));

        exit;
    }
}
