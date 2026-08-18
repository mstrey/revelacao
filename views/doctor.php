<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Cadastro do Sexo</title>
    <link rel="stylesheet" href="/css/doctor.css?v=<?= filemtime(__DIR__ . '/../public/css/doctor.css') ?>">
    <link rel="stylesheet" href="/css/menu.css?v=<?= filemtime(__DIR__ . '/../public/css/menu.css') ?>">
</head>
<body class="has-menu">
    <?php require __DIR__ . '/partials/menu.php'; ?>
    <form method="POST" onsubmit="return confirm('Confirma o registro do sexo selecionado? Não será possível alterar depois.');">
        <h1>Cadastro - Visão Médica</h1>
        <div class="btn-group">
            <div>
                <input type="radio" id="gender_boy" name="gender" value="boy" class="btn-radio" required aria-label="Menino">
                <label for="gender_boy" class="label-btn boy">Menino</label>
            </div>
            <div>
                <input type="radio" id="gender_girl" name="gender" value="girl" class="btn-radio" required aria-label="Menina">
                <label for="gender_girl" class="label-btn girl">Menina</label>
            </div>
        </div>
        <button type="submit">Salvar Resultado</button>
    </form>
</body>
</html>