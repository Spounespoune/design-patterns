<?php

namespace App\Composite\FormGenerator;

class Button extends Element
{
    public function __construct(private string $type, private string $id, private string $name, private string $value)
    {
    }

    public function render(): string
    {
        return "<input type=\"" . $this->type . "\" id=\"" . $this->id . "\" name=\"" . $this->name . "\" value=\"" . $this->value . "\" />";

    }
}