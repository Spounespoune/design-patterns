<?php

namespace App\Tests\DesignPattern\TemplateMethod;

use App\DesignPattern\TemplateMethod\DataExportToCsv;
use App\DesignPattern\TemplateMethod\DataExportToXml;
use App\DesignPattern\TemplateMethod\Storage\FileStorageBasic;
use App\DesignPattern\TemplateMethod\Storage\FileStorageCsv;
use PHPUnit\Framework\TestCase;
use TypeError;


class DataExporterTest extends TestCase
{
    private array $rawData = [
        ['id' => 1, 'name' => 'John Doe', 'age' =>'30'],
        ['id' => 2, 'name' => 'Jane Smith', 'age' => '25'],
        ['id' => 3, 'name' => 'Bob Johnson', 'age' => '40'],
    ];

    public function test_can_export_data_in_csv()
    {
        $fileExpected = __DIR__ . '/ExpectedFile/test.csv';
        $directory = __DIR__ . '/GenerateFile/';
        $filename = 'test.csv';
        $this->cleanFile($directory, $filename);
        $dataExportManager = new DataExportToCsv($this->rawData, new FileStorageCsv($directory, $filename));
        $dataExportManager
            ->generateExport()
        ;

        $this->assertFileEquals($fileExpected,  $directory . $filename);
    }

    public function test_can_export_data_in_xml()
    {
        $fileExpected = __DIR__ . '/ExpectedFile/test.xml';
        $directory = __DIR__ . '/GenerateFile/';
        $filename = 'test.xml';
        $this->cleanFile($directory, $filename);
        $dataExportManager = new DataExportToXml($this->rawData, new FileStorageBasic($directory, $filename));
        $dataExportManager->generateExport();

        $this->assertFileEquals($fileExpected,  $directory . $filename);
    }

    public function test_except_exception()
    {
        $directory = __DIR__ . '/GenerateFile/';
        $filename = 'test_exception.csv';
        $this->cleanFile($directory, $filename);
        $this->expectException(TypeError::class);
        $dataExportManager = new DataExportToCsv([], new FileStorageCsv($directory, $filename));
        $dataExportManager->generateExport();
        $this->assertFileDoesNotExist($directory . $filename);
    }

    private function cleanFile(string $directory, string $filename): void
    {
        if (file_exists($directory.$filename)) {
            unlink($directory.$filename);
        }
    }
}