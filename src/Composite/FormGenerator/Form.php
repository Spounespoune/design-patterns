<?php

namespace App\Composite\FormGenerator;

class Form extends ElementComposite
{
    public function __construct(private string $method, private string $action, private string $class)
    {
    }

    public function render(): string
    {
        $output =  '<form method="' . $this->method . '" action="' . $this->action . '" class="' . $this->class . '">';

        $output .= parent::render();

        return $output . '</form>';
    }
}