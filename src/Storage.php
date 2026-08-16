<?php
namespace App;

class Storage {
    public string $dir;

    public function __construct(string $dir) {
        $this->dir = rtrim($dir, '/');
    }

    public function save(string $key, array $data): void {
        $file = $this->dir . '/' . $key . '.json';
        $fp = @fopen($file, 'c+');
        
        if (!$fp) {
            throw new \RuntimeException("Falha de permissão: não foi possível abrir ou criar o arquivo {$file}");
        }

        if (flock($fp, LOCK_EX)) {
            ftruncate($fp, 0);
            fwrite($fp, json_encode($data));
            fflush($fp);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

    public function load(string $key): array {
        $file = $this->dir . '/' . $key . '.json';
        if (!file_exists($file)) return [];
        $content = file_get_contents($file);
        return json_decode($content, true) ?? [];
    }
}