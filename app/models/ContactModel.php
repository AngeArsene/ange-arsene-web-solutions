<?php

declare(strict_types=1);

namespace application\models;

use application\core\form\FieldInterFace;
use application\core\Model;

final class ContactModel extends Model implements FieldInterFace
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    protected static $FORM_HEADER = '<form action="%s" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">' . "\n\t\t\t";

    protected string $field_input = '
                                        <label for="{{label_id}}-field" class="pb-2">{{label_name}}</label>
                                        <input type="{{input_type}}" name="{{input_name}}" placeholder="{{placeholder}}" value="{{input_value}}" id="{{input_id}}-field" class="form-control {{is-error}}" required="">
                                        <div class="invalid-feedback">
                                            {{error-message}} 
                                        </div>';
    protected string $field_textarea = '
                                            <label for="{{label_id}}-field" class="pb-2">{{label_name}}</label>
                                            <textarea class="form-control {{is-error}}" name="{{input_name}}" placeholder="{{placeholder}}" rows="10" id="{{input_id}}-field" required="">{{input_value}}</textarea>
                                            <div class="invalid-feedback">
                                                {{error-message}} 
                                            </div>';

    protected function field_params(): array
    {
        $has_error = $this->has_error($this->field_attribute) ? 'is-invalid' : '';

        return [
            'label_id' => $this->field_attribute,
            'label_name' => $this->label($this->field_attribute),
            'input_type' => $this->field_type,
            'input_name' => $this->field_attribute,
            'input_value' => $this->{$this->field_attribute},
            'input_id' => $this->field_attribute,
            'placeholder' => $this->placeholder($this->field_attribute),
            'error-message' => $this->get_first_error($this->field_attribute),
            'is-error' => $has_error,
        ];
    }

    public function label(string $attribute): ?string
    {
        return match ($attribute) {
            'name' => 'Your Name',
            'email' => 'Your Email',
            'subject' => 'Subject',
            'message' => 'Message',
            default => null
        };
    }

    public function placeholder(string $attribute): ?string
    {
        return match ($attribute) {
            'name' => 'Enter your name',
            'email' => 'Enter your email address',
            'subject' => 'Enter the subject',
            'message' => 'Enter your message',
            default => null
        };
    }

    /**
     * Defines validation rules for the user model attributes.
     *
     * @return array The validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 4],
                [self::RULE_MAX, 'max' => 255]
            ],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
            ],
            'subject' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 4],
                [self::RULE_MAX, 'max' => 50]
            ],
            'message' => [self::RULE_REQUIRED]
        ];
    }
}
