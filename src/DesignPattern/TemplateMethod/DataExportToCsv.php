<?php

namespace App\DesignPattern\TemplateMethod;

class DataExportToCsv extends DataExport
{

    public function saveIntoFile(): void
    {
        $this->fileStorage->store($this->datas);
    }

    public function writer(): void
    {
    }

    public function parseData(): void
    {
        if (empty($this->rawDatas)) {
            throw new \TypeError('$rawDatas is empty');
        }

        $header = array_keys($this->rawDatas[0]);

        $this->datas = array_merge([$header], $this->rawDatas);
    }
}