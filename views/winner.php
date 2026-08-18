<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>É um(a)...</title>
    <link rel="stylesheet" href="/css/winner.css?v=<?= filemtime(__DIR__ . '/../public/css/winner.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script src="/js/winner.js?v=<?= filemtime(__DIR__ . '/../public/js/winner.js') ?>" defer></script>
</head>
<body>
    <main aria-live="assertive" aria-atomic="true">
        <h2>O nome do bebê é...</h2>
        <h1><?= htmlspecialchars($name) ?></h1>
    </main>
    <script>
        const color = '<?= $gender === 'boy' ? '#0000ff' : '#ff0000' ?>';
    </script>
</body>
</html>