<?php

namespace App\Composite\FormGenerator;

class ParagraphComposite extends ElementComposite
{
    public function render(): string
    {
        $output = '<p>';

        $output .= parent::render();

        return $output . '</p>';
    }
}