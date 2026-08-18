<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Contagem Regressiva</title>
    <link rel="stylesheet" href="/css/countdown.css?v=<?= filemtime(__DIR__ . '/../public/css/countdown.css') ?>">
    <script src="/js/countdown.js?v=<?= filemtime(__DIR__ . '/../public/js/countdown.js') ?>" defer></script>
</head>
<body>
    <h1>O Grande Dia Está Chegando!</h1>
    
    <div class="countdown-wrapper" aria-live="polite" aria-atomic="true">
        <div class="time-box">
            <span class="time-value" id="d">00</span>
            <span class="time-label">Dias</span>
        </div>
        <div class="time-box">
            <span class="time-value" id="h">00</span>
            <span class="time-label">Horas</span>
        </div>
        <div class="time-box">
            <span class="time-value" id="m">00</span>
            <span class="time-label">Minutos</span>
        </div>
        <div class="time-box">
            <span class="time-value" id="s">00</span>
            <span class="time-label">Segundos</span>
        </div>
    </div>

    <script>
        const target = new Date("<?= $revealDate ?>").getTime();
    </script>
</body>
</html>