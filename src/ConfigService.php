<?php
namespace App;

class ConfigService {
    private Storage $storage;
    private const CONFIG_FILE = 'settings';

    public function __construct(Storage $storage) {
        $this->storage = $storage;
    }

    public function saveConfig(array $data): void {
        $this->storage->save(self::CONFIG_FILE, [
            'reveal_date' => $data['reveal_date'] ?? '',
            'lucky_number' => (int)($data['lucky_number'] ?? 1),
            'boy_name' => $data['boy_name'] ?? '',
            'girl_name' => $data['girl_name'] ?? ''
        ]);
    }

    public function getConfig(): array {
        $defaults = [
            'reveal_date' => '',
            'lucky_number' => 1,
            'boy_name' => '',
            'girl_name' => ''
        ];
        $data = $this->storage->load(self::CONFIG_FILE);
        return array_merge($defaults, $data);
    }
}