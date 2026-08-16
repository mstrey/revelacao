<?php
namespace App;

class RevealService {
    private Storage $storage;

    public function __construct(Storage $storage) {
        $this->storage = $storage;
    }

    public function setGender(string $gender): void {
        $this->storage->save('gender', ['result' => $gender]);
    }

    public function getGender(): ?string {
        $data = $this->storage->load('gender');
        return $data['result'] ?? null;
    }

    public function isCountdownActive(): bool {
        $revealDate = strtotime($_ENV['REVEAL_DATE'] ?? 'now');
        return time() < $revealDate;
    }

    public function registerDeviceAccess(string $deviceId): int {
        $file = $this->storage->dir . '/visitors.json';
        $fp = fopen($file, 'c+');
        
        $position = 0;
        if (flock($fp, LOCK_EX)) {
            $content = stream_get_contents($fp);
            $visitors = $content ? json_decode($content, true) : [];
            
            // Verifica se dispositivo já existe
            foreach ($visitors as $v) {
                if ($v['device_id'] === $deviceId) {
                    $position = $v['position'];
                    break;
                }
            }

            // Se for novo, adiciona na fila
            if ($position === 0) {
                $position = count($visitors) + 1;
                $visitors[] = [
                    'device_id' => $deviceId,
                    'position' => $position,
                    'timestamp' => date('Y-m-d H:i:s'),
                    'is_winner' => ($position === (int)$_ENV['LUCKY_NUMBER'])
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
        $lucky = (int)$_ENV['LUCKY_NUMBER'];
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