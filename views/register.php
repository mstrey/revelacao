<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <title>Configuração Inicial</title>
    <link rel="stylesheet" href="/css/auth.css?v=<?= filemtime(__DIR__ . '/../public/css/auth.css') ?>">
</head>
<body>
    <main class="auth-card">
        <h1>Primeiro Acesso</h1>
        <p style="color: #666; margin-bottom: 25px; font-size: 0.95rem;">
            Cadastre o usuário admin.
            Esta ação só pode ser realizada uma vez.
        </p>
        
        <form method="POST">
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" required aria-required="true" autocomplete="username">
            </div>
            
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required aria-required="true" autocomplete="new-password">
            </div>
            
            <button type="submit" class="btn-submit">Criar usuário</button>
        </form>
    </main>
</body>
</html>
