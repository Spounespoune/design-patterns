<?php

namespace App\Composite\FormGenerator;

class InputComposite extends ElementComposite
{
    public function __construct(private string $type, private string $id, private string $name)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function render(): string
    {
        $output =  parent::render();

        return $output . "<input type=\"" . $this->type . "\" id=\"" . $this->id . "\" name=\"" . $this->name . "\" />";
    }
}