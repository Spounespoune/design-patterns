<?php

namespace App\DesignPattern\TemplateMethod\Storage;

class FileStorageBasic implements FileStorageInterface
{

    private string $filenameCompletPath;

    public function __construct(string $directory, string $filename)
    {
        $this->filenameCompletPath = $directory . $filename;
    }

    public function store(array $datas): void
    {
        $file = fopen($this->filenameCompletPath, 'x+');

        foreach ($datas as $data) {
            fputs($file, $data);
        }

        fclose($file);
    }
}