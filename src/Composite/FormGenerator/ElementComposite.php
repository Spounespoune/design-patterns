<?php

namespace App\Composite\FormGenerator;

class ElementComposite extends Element
{
    private array $elements = [];

    public function add(Element $element): void
    {
        $this->elements[] = $element;
        $element->setParent($this);
    }

    public function render(): string
    {
        $output = "";
        /** @var Element $element */
        foreach ($this->elements as $element) {
            $output .= $element->render();
        }

        return $output;
    }
}