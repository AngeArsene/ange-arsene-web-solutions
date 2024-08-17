<?php

declare(strict_types = 1);

/**
 * Dumps the contents of a variable and exits the script.
 *
 * This function is a debugging helper that displays the contents of a variable in a
 * formatted manner, wrapped in HTML pre tags. After displaying the variable, the script
 * is immediately terminated.
 *
 * @param mixed $variable The variable to be dumped.
 */
function dump(mixed $variable): void
{
    // Output the variable in a formatted pre tag
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    // Exit the script after displaying the variable
    exit;
}