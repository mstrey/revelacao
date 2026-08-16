<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Storage;
use App\RevealService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$storage = new Storage(__DIR__ . '/../data');
$service = new RevealService($storage);

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Identificação única do dispositivo via Cookie
$deviceId = $_COOKIE['device_id'] ?? null;
if (!$deviceId) {
    $deviceId = bin2hex(random_bytes(16));
    setcookie('device_id', $deviceId, time() + (86400 * 365), '/');
}

if ($requestUri === '/doctor') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gender = $_POST['gender'] ?? '';
        if (in_array($gender, ['boy', 'girl'])) {
            $service->setGender($gender);
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
    $visitors = $service->getVisitorsList();
    require __DIR__ . '/../views/list.php';
    exit;
}

// Lógica principal para usuários
if ($service->isCountdownActive()) {
    $revealDate = $_ENV['REVEAL_DATE'];
    require __DIR__ . '/../views/countdown.php';
    exit;
}

// Horário passou, processa a fila
$position = $service->registerDeviceAccess($deviceId);
$status = $service->getAccessStatus($position);

if ($status === 'winner') {
    $gender = $service->getGender();
    $name = $gender === 'boy' ? $_ENV['BOY_NAME'] : $_ENV['GIRL_NAME'];
    require __DIR__ . '/../views/winner.php';
} elseif ($status === 'waiting') {
    require __DIR__ . '/../views/waiting.php';
} else {
    require __DIR__ . '/../views/missed.php';
}