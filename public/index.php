<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Storage;
use App\RevealService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$storage = new Storage(__DIR__ . '/../data');
$configService = new \App\ConfigService($storage);
$revealService = new \App\RevealService($storage, $configService);
$authService = new \App\AuthService($storage);

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Identificação única do dispositivo via Cookie
$deviceId = $_COOKIE['device_id'] ?? null;
if (!$deviceId) {
    $deviceId = bin2hex(random_bytes(16));
    setcookie('device_id', $deviceId, time() + (86400 * 365), '/');
}

$protectedRoutes = ['/doctor', '/doctor-success', '/list', '/config'];

if (in_array($requestUri, $protectedRoutes)) {
    if (!$authService->isRegistered()) {
        header("Location: /register");
        exit;
    }
    if (!$authService->isLoggedIn()) {
        header("Location: /login");
        exit;
    }
}

if ($requestUri === '/register') {
    if ($authService->isRegistered()) {
        header("Location: /login");
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = $_POST['username'] ?? '';
        $pass = $_POST['password'] ?? '';
        if ($authService->register($user, $pass)) {
            header("Location: /login");
            exit;
        }
    }
    require __DIR__ . '/../views/register.php';
    exit;
}

if ($requestUri === '/login') {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = $_POST['username'] ?? '';
        $pass = $_POST['password'] ?? '';
        if ($authService->login($user, $pass)) {
            header("Location: /config");
            exit;
        } else {
            $error = 'Credenciais inválidas.';
        }
    }
    require __DIR__ . '/../views/login.php';
    exit;
}

if ($requestUri === '/logout') {
    $authService->logout();
    header("Location: /login");
    exit;
}

if ($requestUri === '/config') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $configService->saveConfig($_POST);
        header("Location: /config?saved=1");
        exit;
    }
    $configData = $configService->getConfig();
    require __DIR__ . '/../views/config.php';
    exit;
}

if ($requestUri === '/doctor') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gender = $_POST['gender'] ?? '';
        if (in_array($gender, ['boy', 'girl'])) {
            $revealService->setGender($gender);
            header("Location: /doctor-success");
            exit;
        }
    }
    require __DIR__ . '/../views/doctor.php';
    exit;
}

if ($requestUri === '/doctor-success') {
    require __DIR__ . '/../views/doctor_success.php';
    exit;
}

if ($requestUri === '/list') {
    $visitors = $revealService->getVisitorsList();
    require __DIR__ . '/../views/list.php';
    exit;
}

$configData = $configService->getConfig();

// Lógica principal para usuários
if ($revealService->isCountdownActive()) {
    $revealDate = $configData['reveal_date'];
    require __DIR__ . '/../views/countdown.php';
    exit;
}

// Horário passou, processa a fila
$position = $revealService->registerDeviceAccess($deviceId);
$status = $revealService->getAccessStatus($position);

if ($status === 'winner') {
    $gender = $revealService->getGender();
    $name = $gender === 'boy' ? $configData['boy_name'] : $configData['girl_name'];
    require __DIR__ . '/../views/winner.php';
} elseif ($status === 'waiting') {
    require __DIR__ . '/../views/waiting.php';
} else {
    require __DIR__ . '/../views/missed.php';
}