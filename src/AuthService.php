<?php
namespace App;

class AuthService {
    private Storage $storage;
    private const ADMIN_FILE = 'admin';

    public function __construct(Storage $storage) {
        $this->storage = $storage;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isRegistered(): bool {
        $data = $this->storage->load(self::ADMIN_FILE);
        return !empty($data['username']);
    }

    public function register(string $username, string $password): bool {
        if ($this->isRegistered()) {
            return false;
        }
        
        $this->storage->save(self::ADMIN_FILE, [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        
        return true;
    }

    public function login(string $username, string $password): bool {
        $data = $this->storage->load(self::ADMIN_FILE);
        
        if (empty($data['username']) || $data['username'] !== $username) {
            return false;
        }

        if (password_verify($password, $data['password'])) {
            $_SESSION['user_logged_in'] = true;
            return true;
        }

        return false;
    }

    public function isLoggedIn(): bool {
        return isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
    }

    public function logout(): void {
        unset($_SESSION['user_logged_in']);
        session_destroy();
    }
}