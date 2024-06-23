<?php

namespace App\DesignPattern\TemplateMethod;

use Exception;
use XMLWriter;

class DataExportManager
{
    private array $rawDatas;
    private array $datas;
    private string $filenameCompletPath;
    public const CSV_FORMAT = 1;
    public const XML_FORMAT = 2;

    public function __construct(array $rawDatas, string $directory, string $filename)
    {
        $this->rawDatas = $rawDatas;
        $this->filenameCompletPath = $directory. $filename;
    }

    /**
     * @throws Exception
     */
    public function generateFile(int $fileFormat): self
    {
        if (self::CSV_FORMAT === $fileFormat) {
            $this->datas = $this->extractDataForCsv();
            $this->csvWriter();
        }

        if (self::XML_FORMAT === $fileFormat) {
            $this->datas = $this->extractDataForXml();
            $this->xmlWriter();
        }

        return $this;
    }

    public function getFilenameCompletPath(): ?string
    {
        return $this->filenameCompletPath;
    }

    private function csvWriter(): void
    {
        $file = fopen($this->filenameCompletPath, 'x+');

        foreach ($this->datas as $data) {
            fputcsv($file, $data);
        }

        fclose($file);
    }

    private function xmlWriter(): void
    {
        $writer = new XMLWriter;
        $writer->openMemory();
        $writer->setIndent(true);
        $writer->setIndentString('    ');;
        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement('people');

        foreach ($this->datas as $data) {

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
        $data = $writer->outputMemory();
        file_put_contents($this->filenameCompletPath, $data);
    }

    private function extractDataForCsv(): array
    {
        if (empty($this->rawDatas)) {
            throw new \TypeError('$rawDatas is empty');
        }

        $header = array_keys($this->rawDatas[0]);

        return array_merge([$header], $this->rawDatas);
    }

    private function extractDataForXml(): array
    {
        if (empty($this->rawDatas)) {
            throw new \TypeError('$rawDatas is empty');
        }

        return $this->rawDatas;
    }
}