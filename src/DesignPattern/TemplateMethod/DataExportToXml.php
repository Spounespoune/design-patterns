<?php

namespace App\DesignPattern\TemplateMethod;

use XMLWriter;

class DataExportToXml extends DataExport
{

    protected function saveIntoFile(): void
    {
        $this->fileStorage->store($this->datas);
    }

    protected function writer(): void
    {
        $writer = new XMLWriter;
        $writer->openMemory();
        $writer->setIndent(true);
        $writer->setIndentString('    ');;
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement('people');

        foreach ($this->rawDatas as $data) {

            $writer->startElement('person');
            foreach ($data as $key => $value) {
                $writer->startElement($key);
                $writer->text($value);
                $writer->endElement();
            }

            $writer->endElement();
        }

        $writer->endElement();
        $writer->endDocument();
        $this->datas = [$writer->outputMemory()];
    }

    protected function parseData(): void
    {
        if (empty($this->rawDatas)) {
            throw new \TypeError('$rawDatas is empty');
        }

        $this->datas = $this->rawDatas;
    }
}