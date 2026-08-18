<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\RevealService;
use App\ConfigService;
use App\Storage;

class RevealServiceTest extends TestCase {
    private string $testDataDir = __DIR__ . '/../data_test';
    private RevealService $service;

    protected function setUp(): void {
        if (!is_dir($this->testDataDir)) {
            mkdir($this->testDataDir);
        }
        $storage = new Storage($this->testDataDir);
        
        $configService = new ConfigService($storage);
        $configService->saveConfig([
            'reveal_date' => date('Y-m-d\TH:i'), // Já passou
            'lucky_number' => 2,
            'boy_name' => 'Menino Teste',
            'girl_name' => 'Menina Teste'
        ]);

        $this->service = new RevealService($storage, $configService);
    }

    protected function tearDown(): void {
        array_map('unlink', glob("$this->testDataDir/*.*"));
        rmdir($this->testDataDir);
    }

    public function testDoctorCanSetGender() {
        $this->service->setGender('boy');
        $this->assertEquals('boy', $this->service->getGender());
    }

    public function testDeviceQueueAssignment() {
        $deviceId1 = 'device-123';
        $deviceId2 = 'device-456';
        
        $pos1 = $this->service->registerDeviceAccess($deviceId1);
        $pos2 = $this->service->registerDeviceAccess($deviceId2);
        $pos1_repeat = $this->service->registerDeviceAccess($deviceId1);

        $this->assertEquals(1, $pos1);
        $this->assertEquals(2, $pos2);
        $this->assertEquals(1, $pos1_repeat); // Mesmo dispositivo, mesma posição
    }

    public function testRevealStatusForDevices() {
        $this->service->setGender('girl');
        
        $pos1 = $this->service->registerDeviceAccess('dev1'); // Posição 1 (< 2)
        $pos2 = $this->service->registerDeviceAccess('dev2'); // Posição 2 (== 2) WINNER
        $pos3 = $this->service->registerDeviceAccess('dev3'); // Posição 3 (> 2)

        $this->assertEquals('waiting', $this->service->getAccessStatus($pos1));
        $this->assertEquals('winner', $this->service->getAccessStatus($pos2));
        $this->assertEquals('missed', $this->service->getAccessStatus($pos3));
    }
}