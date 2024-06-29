<?php

namespace App\DesignPattern\TemplateMethod;

use App\DesignPattern\TemplateMethod\Storage\FileStorageInterface;
use XMLWriter;

Abstract class DataExport
{
    protected array $rawDatas;
    protected array $datas;
    protected FileStorageInterface $fileStorage;

    public function __construct(
        array $rawDatas,
        FileStorageInterface $fileStorage
    ) {
        $this->rawDatas = $rawDatas;
        $this->fileStorage = $fileStorage;
    }

    public function generateExport(): void
    {
        $this->parseData();
        $this->writer();
        $this->saveIntoFile();
    }

    abstract protected function saveIntoFile(): void;

    abstract protected function writer(): void;

    abstract protected function parseData(): void;
}