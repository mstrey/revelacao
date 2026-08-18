<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Sucesso</title>
    <link rel="stylesheet" href="/css/doctor_success.css">
    <link rel="stylesheet" href="/css/menu.css?v=<?= filemtime(__DIR__ . '/../public/css/menu.css') ?>">
</head>
<body class="has-menu">
    <?php require __DIR__ . '/partials/menu.php'; ?>
    <main class="success-card">
        <div class="icon-success" aria-hidden="true">✓</div>
        <h1>Registro Salvo com Sucesso!</h1>
        <p>Obrigado. O sistema foi configurado com sucesso.</p>
    </main>
</body>
</html>