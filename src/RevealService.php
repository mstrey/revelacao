<?php
namespace App;

class RevealService {
    private Storage $storage;
    private ConfigService $config;

    public function __construct(Storage $storage, ConfigService $config) {
        $this->storage = $storage;
        $this->config = $config;
    }

    public function setGender(string $gender): void {
        $this->storage->save('gender', ['result' => $gender]);
    }

    public function getGender(): ?string {
        $data = $this->storage->load('gender');
        return $data['result'] ?? null;
    }

    public function isCountdownActive(): bool {
        $cfg = $this->config->getConfig();
        if (empty($cfg['reveal_date'])) {
            return true;
        }
        $revealDate = strtotime($cfg['reveal_date']);
        return time() < $revealDate;
    }

    public function registerDeviceAccess(string $deviceId): int {
        $file = $this->storage->dir . '/visitors.json';
        $fp = @fopen($file, 'c+');
        if (!$fp) {
            throw new \RuntimeException("Falha ao abrir visitors.json");
        }
        
        $position = 0;
        $cfg = $this->config->getConfig();
        $luckyNumber = $cfg['lucky_number'];

        if (flock($fp, LOCK_EX)) {
            $content = stream_get_contents($fp);
            $visitors = $content ? json_decode($content, true) : [];
            
            foreach ($visitors as $v) {
                if ($v['device_id'] === $deviceId) {
                    $position = $v['position'];
                    break;
                }
            }

            if ($position === 0) {
                $position = count($visitors) + 1;
                $visitors[] = [
                    'device_id' => $deviceId,
                    'position' => $position,
                    'timestamp' => date('Y-m-d H:i:s'),
                    'is_winner' => ($position === $luckyNumber)
                ];
                ftruncate($fp, 0);
                rewind($fp);
                fwrite($fp, json_encode($visitors));
            }
            fflush($fp);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
        
        return $position;
    }

    public function getAccessStatus(int $position): string {
        $cfg = $this->config->getConfig();
        $lucky = $cfg['lucky_number'];
        
        if ($position < $lucky) {
            return 'waiting';
        }
        if ($position === $lucky) {
            return 'winner';
        }
        return 'missed';
    }

    public function getVisitorsList(): array {
        return $this->storage->load('visitors');
    }
}