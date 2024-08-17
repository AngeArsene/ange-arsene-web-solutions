<?php

declare(strict_types=1);

namespace application\forms;

use application\core\form\Form;

final class ContactForm extends Form
{
    protected string $field_input = '<div class="col-md-6">
                                        <label for="{{label_id}}-field" class="pb-2">{{label_name}}</label>
                                        <input type="{{input_type}}" name="{{input_name}}" value="{{input_value}}" id="{{input_id}}-field" class="form-control" required="">
                                    </div>';
    protected string $field_textarea = '<div class="col-md-12">
                                            <label for="{{label_id}}-field" class="pb-2">{{label_name}}</label>
                                            <textarea class="form-control" name="{{input_name}}" rows="10" id="{{input_id}}-field" required="">{{input_value}}</textarea>
                                        </div>';

    protected function params(): array
    {
        return [
            'label_id' => ''
        ];
    }
}
