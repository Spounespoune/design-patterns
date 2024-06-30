<?php

namespace App\Composite\FormGenerator;

class Label extends Element
{
    public function __construct(private string $label)
    {
    }

    public function render(): string
    {
        $forAttribute = '';
        $parent = $this->getParent();

        if (get_class($parent) === InputComposite::class) {
            $forAttribute = 'for="' . $parent->getId() . '"';
        }

        return '<label '. $forAttribute .'>' . $this->label . '</label>';
    }
}