<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Página Não Encontrada</title>
    <link rel="stylesheet" href="/css/404.css?v=<?= @filemtime(__DIR__ . '/../public/css/404.css') ?>">
</head>
<body>
    <main class="error-container">
        <div class="icon-404" aria-hidden="true">🍼</div>
        <h1>Ops! Erro 404</h1>
        <p>Parece que o bebê brincou de esconde-esconde com esta página e nós não conseguimos encontrá-la.</p>
        <a href="/" class="btn-home" aria-label="Voltar para a página inicial">Voltar para o Início</a>
    </main>
</body>
</html>