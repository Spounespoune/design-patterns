<?php

namespace App\Composite\FormGenerator;

class Input extends Element
{
    public function __construct(private string $type, private string $id, private string $name)
    {
    }

    public function render(): string
    {
        return "<input type=\"" . $this->type . "\" id=\"" . $this->id . "\" name=\"" . $this->name . "\" />";
    }
}