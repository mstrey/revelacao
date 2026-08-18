<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\AuthService;
use App\Storage;

class AuthServiceTest extends TestCase {
    private string $testDataDir = __DIR__ . '/../data_test';
    private AuthService $service;

    protected function setUp(): void {
        if (!is_dir($this->testDataDir)) {
            mkdir($this->testDataDir);
        }
        $storage = new Storage($this->testDataDir);
        
        // Simula o array de sessão para o ambiente CLI do PHPUnit
        if (session_status() === PHP_SESSION_NONE) {
            $_SESSION = [];
        }
        
        $this->service = new AuthService($storage);
    }

    protected function tearDown(): void {
        array_map('unlink', glob("$this->testDataDir/*.*"));
        rmdir($this->testDataDir);
    }

    public function testCanRegisterFirstAdmin() {
        $this->assertFalse($this->service->isRegistered());
        $this->assertTrue($this->service->register('medico', 'senha123'));
        $this->assertTrue($this->service->isRegistered());
    }

    public function testCannotRegisterMultipleUsers() {
        $this->service->register('medico', 'senha123');
        $this->assertFalse($this->service->register('invasor', 'outrasenha'));
    }

    public function testLoginSuccessAndFailure() {
        $this->service->register('medico', 'senha123');
        
        $this->assertFalse($this->service->login('medico', 'senhaerrada'));
        $this->assertFalse($this->service->isLoggedIn());

        $this->assertTrue($this->service->login('medico', 'senha123'));
        $this->assertTrue($this->service->isLoggedIn());
    }
}