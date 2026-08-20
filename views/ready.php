<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Chegou a Hora!</title>
    <link rel="stylesheet" href="/css/ready.css?v=<?= filemtime(__DIR__ . '/../public/css/ready.css') ?>">
</head>
<body>
    <main class="ready-card">
        <h1>O momento chegou!</h1>
        <p>A contagem regressiva terminou. O resultado já está disponível para os dispositivos na fila.</p>
        
        <form method="POST" action="/">
            <button type="submit" class="btn-reveal" aria-label="Descobrir o resultado do sexo do bebê">Descobrir Resultado</button>
        </form>
    </main>
</body>
</html>