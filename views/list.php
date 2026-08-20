<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require __DIR__ . '/partials/head.php'; ?>
    <meta http-equiv="refresh" content="10">
    <title>Lista de Acessos</title>
    <link rel="stylesheet" href="/css/list.css?v=<?= filemtime(__DIR__ . '/../public/css/list.css') ?>">
    <link rel="stylesheet" href="/css/menu.css?v=<?= filemtime(__DIR__ . '/../public/css/menu.css') ?>">
</head>
<body class="has-menu">
    <?php require __DIR__ . '/partials/menu.php'; ?>
    <h1>Lista de Dispositivos na Fila</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Posição</th>
                    <th>ID do Dispositivo</th>
                    <th>Data/Hora do Acesso</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visitors as $v): ?>
                    <tr class="<?= $v['is_winner'] ? 'winner' : '' ?>">
                        <td><strong>#<?= $v['position'] ?></strong></td>
                        <td><span title="<?= htmlspecialchars($v['device_id']) ?>"><?= htmlspecialchars(substr($v['device_id'], 0, 8)) ?>...</span></td>
                        <td><?= $v['timestamp'] ?></td>
                        <td>
                            <span class="status-badge">
                                <?= $v['is_winner'] ? 'Sorteado' : 'Comum' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>