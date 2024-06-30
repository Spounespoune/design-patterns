<?php

namespace App\Composite\FormGenerator;

abstract class Element
{
    private ?Element $parent = null;

    public function setParent(?Element $element): void
    {
        $this->parent = $element;
    }

    public function getParent(): ?Element
    {
        return $this->parent;
    }

    abstract public function render(): string;
}