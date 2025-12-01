<?php
/**
 * Arquivo reutilizável para verificar se o usuário está autenticado
 * Use: require_once 'bd/verifica_sessao.php'; no início de páginas que precisam de autenticação
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    // Se não estiver logado, redireciona para o login
    header("Location: ../login/login.php");
    exit();
}

// Retorna os dados do usuário logado (opcional, para uso nas páginas)
$usuario_logado = [
    'id' => $_SESSION['id_usuario'],
    'nome' => $_SESSION['nome'] ?? '',
    'nivel' => $_SESSION['nivel'] ?? 'operador'
];
?>

