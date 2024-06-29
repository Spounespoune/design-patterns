<?php

namespace App\DesignPattern\TemplateMethod\Storage;

interface FileStorageInterface
{
    public function store(array $datas): void;
}