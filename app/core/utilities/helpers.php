<?php

declare(strict_types=1);

use application\core\View;
use application\core\http\Request;

/**
 * Helper function to create and return a View object.
 *
 * @param string $name The name of the view file to render.
 * @param string|null $layout The name of the layout file to use (optional).
 * @param array $params The parameters to pass to the view (optional).
 * @return View The rendered View object.
 */
function view(string $name, ?string $layout = null, array $params = []): View
{
    // If no layout is provided, use the main layout by default
    $layout = $layout ?? View::$MAIN_LAYOUT;

    // Create a new View object with the provided name, layout, and parameters
    return new View($name, $layout, $params);
}
