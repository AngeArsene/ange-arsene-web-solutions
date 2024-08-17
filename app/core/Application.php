<?php

declare(strict_types=1);

namespace application\core;

use Exception;
use application\core\http\Response;
use application\core\exceptions\HTTPException;

/**
 * The Application class is the main entry point for the application. It is responsible for
 * initializing the necessary components, handling the request routing, and executing the
 * appropriate actions.
 */
final class Application
{
    /**
     * The Router object responsible for handling the application's routing.
     */
    public Router $router;

    /**
     * The Response object used to manage the application's HTTP responses.
     */
    public Response $response;

    /**
     * The MiddlewareStack object used to manage the application's middleware.
     */
    public MiddlewareStack $middlewares;

    /**
     * The root directory of the application.
     */
    public static string $ROOT_DIR;

    /**
     * Constructs a new instance of the Application class.
     *
     * In the constructor, the Router, Response, and MiddlewareStack objects are created,
     * and the root directory of the application is set.
     */
    public function __construct()
    {
        $this->response = new Response();
        $this->router = new Router($this->response);

        $this->middlewares = new MiddlewareStack();

        self::$ROOT_DIR = dirname(__DIR__);
    }

    /**
     * Runs the application by resolving the appropriate action based on the requested URL.
     *
     * This method calls the `resolve()` method of the Router object, which returns the
     * appropriate action to be executed. The result of the action is then echoed to the
     * output.
     */
    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (Exception $exception) {
            $this->handle($exception);
        }
    }

    /**
     * Handles exceptions that occur during the application's execution.
     *
     * If the exception is a subclass of HTTPException, the response status code is set
     * accordingly, and the appropriate error view is rendered. For other types of
     * exceptions, a generic error message may be displayed or logged.
     *
     * @param Exception $exception The exception to be handled.
     */
    private function handle(Exception $exception): void
    {
        if (is_subclass_of($exception, HTTPException::class)) {
            $this->response->set_status_code($exception->getCode());
            echo view('error', 'main-error', $exception->parameters());
        }
        // Add additional exception handling logic as needed
    }
}
