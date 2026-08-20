<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Configurações da Revelação</title>
    <link rel="stylesheet" href="/css/menu.css?v=<?= filemtime(__DIR__ . '/../public/css/menu.css') ?>">
    <link rel="stylesheet" href="/css/config.css?v=<?= filemtime(__DIR__ . '/../public/css/config.css') ?>">
</head>
<body class="has-menu">
    <?php require __DIR__ . '/partials/menu.php'; ?>

    <main class="config-container">
        <h1>Configurações do Evento</h1>
        
        <?php if (isset($_GET['saved'])) { ?>
            <div class="alert-success" role="alert">Configurações salvas com sucesso!</div>
        <?php } ?>

        <?php if (isset($_GET['cleared'])) { ?>
            <div class="alert-info" role="alert">A lista de visitantes foi zerada com sucesso!</div>
        <?php } ?>

        <form method="POST">
            <div class="form-group">
                <label for="reveal_date">Data e Hora da Revelação</label>
                <input type="datetime-local" id="reveal_date" name="reveal_date" value="<?= htmlspecialchars($configData['reveal_date']) ?>" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="lucky_number">Posição Sorteada na Fila</label>
                <input type="number" id="lucky_number" name="lucky_number" value="<?= htmlspecialchars($configData['lucky_number']) ?>" min="1" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="boy_name">Nome se for Menino</label>
                <input type="text" id="boy_name" name="boy_name" value="<?= htmlspecialchars($configData['boy_name']) ?>" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="girl_name">Nome se for Menina</label>
                <input type="text" id="girl_name" name="girl_name" value="<?= htmlspecialchars($configData['girl_name']) ?>" required aria-required="true">
            </div>

            <div class="form-group">
                <label for="timezone">Fuso Horário</label>
                <select id="timezone" name="timezone" required aria-required="true">
                    <option value="America/Sao_Paulo" <?= $configData['timezone'] === 'America/Sao_Paulo' ? 'selected' : '' ?>>Horário de Brasília (São Paulo)</option>
                    <option value="America/Manaus" <?= $configData['timezone'] === 'America/Manaus' ? 'selected' : '' ?>>Amazonas (Manaus)</option>
                    <option value="America/Cuiaba" <?= $configData['timezone'] === 'America/Cuiaba' ? 'selected' : '' ?>>Mato Grosso (Cuiabá)</option>
                    <option value="America/Rio_Branco" <?= $configData['timezone'] === 'America/Rio_Branco' ? 'selected' : '' ?>>Acre (Rio Branco)</option>
                    <option value="America/Noronha" <?= $configData['timezone'] === 'America/Noronha' ? 'selected' : '' ?>>Fernando de Noronha</option>
                    <option value="UTC" <?= $configData['timezone'] === 'UTC' ? 'selected' : '' ?>>UTC (Tempo Universal)</option>
                </select>
            </div>
            
            <button type="submit" class="btn-submit">Salvar Configurações</button>
        </form>

        <div class="danger-zone">
            <h2>Gerenciamento de Dados</h2>
            <p style="color: #666; margin-bottom: 15px;">Ao executar esta ação, todos os registros de acesso dos dispositivos serão apagados permanentemente.</p>
            <form method="POST" onsubmit="return confirm('Tem certeza que deseja zerar a lista de visitantes? Esta ação não pode ser desfeita.');">
                <input type="hidden" name="action" value="clear_visitors">
                <button type="submit" class="btn-submit btn-danger">Zerar Lista de Visitantes</button>
            </form>
        </div>
    </main>
</body>
</html>
