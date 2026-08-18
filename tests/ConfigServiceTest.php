<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\ConfigService;
use App\Storage;

class ConfigServiceTest extends TestCase {
    private string $testDataDir = __DIR__ . '/../data_test';
    private ConfigService $service;

    protected function setUp(): void {
        if (!is_dir($this->testDataDir)) {
            mkdir($this->testDataDir);
        }
        $storage = new Storage($this->testDataDir);
        $this->service = new ConfigService($storage);
    }

    protected function tearDown(): void {
        array_map('unlink', glob("$this->testDataDir/*.*"));
        rmdir($this->testDataDir);
    }

    public function testCanSaveAndLoadConfiguration() {
        $data = [
            'reveal_date' => '2026-12-31T23:59',
            'lucky_number' => 5,
            'boy_name' => 'Enzo',
            'girl_name' => 'Valentina'
        ];

        $this->service->saveConfig($data);
        $loaded = $this->service->getConfig();

        $this->assertEquals('2026-12-31T23:59', $loaded['reveal_date']);
        $this->assertEquals(5, $loaded['lucky_number']);
        $this->assertEquals('Enzo', $loaded['boy_name']);
        $this->assertEquals('Valentina', $loaded['girl_name']);
    }

    public function testReturnsDefaultValuesWhenEmpty() {
        $loaded = $this->service->getConfig();
        $this->assertArrayHasKey('reveal_date', $loaded);
        $this->assertEquals(1, $loaded['lucky_number']);
    }
}