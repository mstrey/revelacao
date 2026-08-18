<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Acesso Médico</title>
    <link rel="stylesheet" href="/css/auth.css?v=<?= filemtime(__DIR__ . '/../public/css/auth.css') ?>">
</head>
<body>
    <main class="auth-card">
        <h1>Acesso Restrito</h1>
        
        <?php if (!empty($error)) { ?>
            <div class="error-msg" role="alert"><?= htmlspecialchars($error) ?></div>
        <?php } ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" required aria-required="true" autocomplete="username">
            </div>
            
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required aria-required="true" autocomplete="current-password">
            </div>
            
            <button type="submit" class="btn-submit">Entrar</button>
        </form>
    </main>
</body>
</html>
