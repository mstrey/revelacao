<?php
if (isset($authService) && $authService->isLoggedIn()) {
?>
    <header class="admin-menu">
        <div class="menu-brand" aria-label="Painel Administrativo">Painel Médico</div>
        <nav aria-label="Menu Principal">
            <a href="/config">Configurações</a>
            <a href="/doctor">Cadastro de Sexo</a>
            <a href="/list">Lista de Acessos</a>
            <a href="/logout">Sair</a>
        </nav>
    </header>
<?php
}
?>