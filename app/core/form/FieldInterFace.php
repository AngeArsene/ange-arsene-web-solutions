<?php

declare(strict_types=1);

namespace application\core\form;

/**
 * Interface FieldInterface
 * 
 * Defines the contract for form field components.
 */
interface FieldInterFace
{
    /**
     * Gets the label for the specified form field attribute.
     * 
     * @param string $attribute The attribute of the form field
     * @return ?string The label for the form field, or null if not set
     */
    public function label(string $attribute): ?string;

    /**
     * Gets the placeholder for the specified form field attribute.
     * 
     * @param string $attribute The attribute of the form field
     * @return ?string The placeholder for the form field, or null if not set
     */
    public function placeholder(string $attribute): ?string;
}
