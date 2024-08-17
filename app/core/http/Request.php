<?php

declare(strict_types=1);

namespace application\core\http;

use application\core\http\exceptions\NotImplementedException;

/**
 * Represents an HTTP request received by the application.
 *
 * This class provides methods to retrieve information about the current request, such as
 * the request path and HTTP method.
 */
final class Request
{
    private const METHODS = ['get', 'post', 'put', 'patch', 'delete'];

    private array $routeParams = [];

    /**
     * Gets the path of the current request.
     *
     * This method extracts the path from the `$_SERVER['REQUEST_URI']` global variable,
     * removing any query string parameters that may be present.
     *
     * @return string The path of the current request.
     */
    public function get_path(): string
    {
        // Get the full request URI
        $path = $_SERVER['REQUEST_URI'];

        // Find the position of the query string (if any)
        $position = strpos($path, '?');

        // If there's no query string, return the full path
        // Otherwise, return the path up to the query string
        return $position ? substr($path, 0, $position) : $path;
    }

    /**
     * Gets the HTTP method of the current request.
     *
     * This method retrieves the HTTP method from the `$_SERVER['REQUEST_METHOD']` global
     * variable and converts it to lowercase. If the `_method` parameter is present in the
     * request body, it takes precedence over the server-provided method.
     *
     * @return string The HTTP method of the current request.
     */
    public function get_method(): string
    {
        // Get the HTTP method from the global server variables and convert it to lowercase
        return strtolower($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
    }

    public function get_body(): array
    {
        $body = [];

        switch ($this->get_method()) {
            case 'get':
                foreach ($_GET as $key => $_value) {
                    $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;

            default:
                foreach ($_POST as $key => $_value) {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                break;
        }

        return $body;
    }


    public function get_route_params($param, $default = null): ?string
    {
        return $this->routeParams[$param] ?? $default;
    }

    public function set_route_params($params): void
    {
        $this->routeParams = $params;
    }


    public function method_is(string $method): bool
    {
        if (array_search($method, self::METHODS) !== false) {
            return $this->get_method() === $method;
        } else {
            throw new NotImplementedException();
        }
    }

    /**
     * Returns the list of supported HTTP methods.
     *
     * @return array The list of supported HTTP methods.
     */
    public function methods(): array
    {
        return self::METHODS;
    }

    /**
     * Outputs an HTML input field to override the HTTP method of the current request.
     *
     * This method is useful when working with forms that need to send a different HTTP
     * method than the default (typically POST).
     *
     * @param string $method The HTTP method to override (e.g., 'put', 'patch', 'delete').
     */
    public static function method(string $method): string
    {
        $string = '<input type="hidden" name="_method" value="%s">' . "\n";

        // Output the HTML input field only if the provided method is supported
        return (array_search($method, self::METHODS) !== false ? sprintf($string, $method) : null);
    }
}
