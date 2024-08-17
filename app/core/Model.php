<?php

declare(strict_types=1);

namespace application\core;

use application\core\form\FieldInterFace;
use application\core\form\Form;
use application\core\http\Request;

/**
 * Class Model
 *
 * Represents the base model class for the application.
 */
abstract class Model implements FieldInterFace
{
    protected const RULE_REQUIRED = 'required'; // Constant representing the required rule
    protected const RULE_EMAIL = 'email'; // Constant representing the email rule
    protected const RULE_MIN = 'min'; // Constant representing the minimum length rule
    protected const RULE_MAX = 'max'; // Constant representing the maximum length rule
    protected const RULE_MATCH = 'match'; // Constant representing the match rule

    protected static $FORM_HEADER;

    protected string $field_input = '';
    protected string $field_textarea = '';

    protected ?string $field_type = '';
    protected string $field_attribute = '';

    /**
     * @var array Stores the validation errors
     */
    private array $errors = []; // Array to store validation errors

    /**
     * Model constructor.
     *
     * @param array $data The data to populate the model properties
     */
    final public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract protected function field_params(): ?array;


    private function render_field(string $body): string
    {
        $start = strpos($body, '{{');
        $end = strpos($body, '}}');

        if ($start && $end) {
            $placeholder = substr($body, $start, ($end - $start) + 2);
            $placeholder_name = trim($placeholder, '{{}}');

            $param = $this->field_params()[$placeholder_name] ?? '';

            return $this->render_field(str_replace($placeholder, $param, $body));
        }

        return $body;
    }

    public function form_input_field(string $attribute, ?string $type = null): void
    {
        $this->field_type = $type;
        $this->field_attribute = $attribute;

        echo $this->render_field($this->field_input);
    }

    public function form_textarea_field(string $attribute): void
    {
        $this->field_attribute = $attribute;

        echo $this->render_field($this->field_textarea);
    }

    public function begin_form(string $method, string $action = ""): void
    {
        echo sprintf(static::$FORM_HEADER . Request::method($method), htmlspecialchars($action));
    }

    public function end_form(): void
    {
        echo '</form>' . "\n";
    }

    /**
     * Defines the validation rules for the model attributes.
     *
     * @return array The validation rules
     */
    abstract protected function rules(): array; // Abstract method to define validation rules for model attributes

    /**
     * Returns the label for a specific attribute.
     *
     * @param string $attribute The attribute name
     * @return string|null The label or null if not defined
     */
    public function label(string $attribute): ?string
    {
        return null;
    }

    /**
     * Returns the placeholder for a specific attribute.
     *
     * @param string $attribute The attribute name
     * @return string|null The placeholder or null if not defined
     */
    public function placeholder(string $attribute): ?string
    {
        return null;
    }

    /**
     * Validates the model attributes based on the defined rules.
     *
     * @return bool Whether the validation passed or not
     */
    final public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = is_array($rule) ? $rule[0] : $rule;

                if ($ruleName === self::RULE_REQUIRED && !$value) { // Check if the value is required but empty
                    $this->add_error($attribute, $ruleName); // Add an error for the attribute and rule
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) { // Check if the value is not a valid email
                    $this->add_error($attribute, $ruleName); // Add an error for the attribute and rule
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) { // Check if the length of the value is less than the minimum length
                    $this->add_error($attribute, $ruleName, $rule); // Add an error for the attribute, rule, and rule parameters
                } elseif ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) { // Check if the length of the value is greater than the maximum length
                    $this->add_error($attribute, $ruleName, $rule); // Add an error for the attribute, rule, and rule parameters
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) { // Check if the value does not match the value of another attribute
                    $this->add_error($attribute, $ruleName, $rule); // Add an error for the attribute, rule, and rule parameters
                }
            }
        }

        return empty($this->errors); // Return whether there are any errors or not
    }

    /**
     * Returns the error message for a specific rule.
     *
     * @param string $rule The rule name
     * @return string The error message
     */
    private function error_message(string $rule): string
    {
        return match ($rule) { // Generate an error message based on the rule name
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'The minimum length of this field must be {min}',
            self::RULE_MAX => 'The maximum length of this field must be {max}',
            self::RULE_MATCH => 'This field must match the value of {match}',
            default => 'Invalid input. Please check your input and try again'
        };
    }

    /**
     * Adds an error to the errors array.
     *
     * @param string $attribute The attribute name
     * @param string $rule The rule name
     * @param array $params The parameters for the error message
     * @return void
     */
    private function add_error(string $attribute, string $rule, array $params = []): void
    {
        $message = $this->error_message($rule); // Get the error message for the rule

        foreach ($params as $key => $value) {
            $position = strpos($message, "{$key}");

            if ($position !== false) {
                $value = $this->label("$value") ?? "$value";
                $message = str_replace("{{$key}}", $value, $message); // Replace placeholders in the error message with the actual values
            }
        }

        $this->errors[$attribute][] = $message; // Add the error message to the errors array for the attribute
    }

    /**
     * Checks if an attribute has any errors.
     *
     * @param string $attribute The attribute name
     * @return bool Whether the attribute has errors or not
     */
    public function has_error(string $attribute): bool
    {
        return !empty($this->errors[$attribute]); // Check if the attribute has any errors in the errors array
    }

    /**
     * Gets the first error message for a specific attribute.
     *
     * @param string $attribute The attribute name
     * @return string The error message
     */
    public function get_first_error(string $attribute): string
    {
        return $this->errors[$attribute][0] ?? ''; // Get the first error message for the attribute from the errors array
    }
}
